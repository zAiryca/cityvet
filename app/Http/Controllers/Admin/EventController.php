<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $events = Event::with('registrations')->orderBy('event_date')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        if (!Auth::user()->isAdmin()) abort(403);
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'event_date' => 'required|date|after:now',
            'location' => 'required|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();
        Event::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event created.');
    }

    public function show(Event $event)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $event->load('registrations.pet.user');
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        $event->update($validated);

        return redirect()->route('admin.events.index')->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        // Delete registrations first
        $event->registrations()->delete();
        $event->delete();
        return back()->with('success', 'Event deleted.');
    }

    // Custom: Generate event report (simple list of registered pets)
    public function report(Event $event)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $registrations = $event->registrations()->with('pet.user')->get();
        // You can extend to PDF similar to main report
        return view('admin.events.report', compact('event', 'registrations'));
    }
}
