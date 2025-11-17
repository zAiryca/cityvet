<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin()) abort(403);

        $query = Announcement::query();

        // Apply filters
        if (request('search')) {
            $query->where('title', 'like', '%' . request('search') . '%');
        }

        if (request('category')) {
            $query->where('category', request('category'));
        }

        if (request('event_date')) {
            $query->whereDate('created_at', request('event_date'));
        }

        $announcements = $query->orderBy('created_at', 'desc')->paginate(10);
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
            'category' => 'required|in:Event,Trivia,Fun Fact,Holiday Notice',
            'date_when' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);

        Announcement::create($validated);

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement created.');
    }

    public function show(Announcement $announcement)
    {
        if (!Auth::user()->isAdmin()) abort(403);
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
            'category' => 'required|in:Event,Trivia,Fun Fact,Holiday Notice',
            'date_when' => 'nullable|string',
            'location' => 'nullable|string|max:255',
        ]);

        $announcement->update($validated);

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $announcement->delete();
        return back()->with('success', 'Announcement deleted.');
    }


}
