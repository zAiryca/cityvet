<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\AnnouncementRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $announcements = Announcement::with('registrations')->orderBy('event_date')->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        if (!Auth::user()->isAdmin()) abort(403);
        return view('admin.announcements.create');
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
        Announcement::create($validated);

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement created.');
    }

    public function show(Announcement $announcement)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $announcement->load('registrations.pet.user');
        return view('admin.announcements.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        $announcement->update($validated);

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        // Delete registrations first
        $announcement->registrations()->delete();
        $announcement->delete();
        return back()->with('success', 'Announcement deleted.');
    }


}
