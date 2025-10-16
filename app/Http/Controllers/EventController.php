<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::orderBy('event_date')->paginate(9);
        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load('registrations.pet');
        $myRegistration = Auth::check() ? $event->registrations()->where('user_id', Auth::id())->first() : null;
        $myPets = Auth::check() ? Auth::user()->pets()->where('status', 'registered')->get() : collect();
        return view('events.show', compact('event', 'myRegistration', 'myPets'));
    }

    // User registers pet for event
    public function register(Request $request, Event $event)
    {
        $request->validate(['pet_id' => 'required|exists:pets,id']);
        $pet = Pet::findOrFail($request->pet_id);
        if ($pet->user_id !== Auth::id() || $pet->status !== 'registered') {
            return back()->with('error', 'Invalid pet.');
        }
        if (EventRegistration::where('event_id', $event->id)->where('pet_id', $pet->id)->exists()) {
            return back()->with('error', 'Already registered.');
        }

        EventRegistration::create([
            'event_id' => $event->id,
            'pet_id' => $pet->id,
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Pet registered for event!');
    }

    // Admin create (basic)
    public function adminStore(Request $request)
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
}
