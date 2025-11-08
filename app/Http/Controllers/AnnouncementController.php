<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $announcements = Announcement::orderBy('event_date')->paginate(9);
        return view('events.index', compact('announcements'));
    }

    public function show(Announcement $announcement)
    {
        return view('events.show', compact('announcement'));
    }



    // Admin create (basic)
    public function adminStore(Request $request)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'type' => 'required|string|max:50',
            'description' => 'required|string',
            'event_date' => 'required|date|after:now',
            'location' => 'required|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();
        Announcement::create($validated);

        return redirect()->route('admin.events.index')->with('success', 'Announcement created.');
    }
}
