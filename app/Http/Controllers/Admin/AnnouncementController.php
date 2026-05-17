<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Announcement;
use App\Models\AnnouncementPhoto;
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
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Remove photos from validated data (not stored directly in announcements table)
        unset($validated['photos']);

        $announcement = Announcement::create($validated);

        // Handle multiple photo uploads
        if ($request->hasFile('photos')) {
            $order = 0;
            foreach ($request->file('photos') as $photo) {
                if ($photo) {
                    $path = $photo->store('announcements', 'public');
                    AnnouncementPhoto::create([
                        'announcement_id' => $announcement->id,
                        'photo_path' => $path,
                        'order' => $order++,
                    ]);
                }
            }
        }

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
            'photos' => 'nullable|array',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'deleted_photos' => 'nullable|string',
        ]);

        // Remove photos and deleted_photos from validated data
        $photos = $request->file('photos') ?? [];
        $deletedPhotosJson = $validated['deleted_photos'] ?? '[]';

        // Decode the JSON string to get the array
        $deletedPhotos = json_decode($deletedPhotosJson, true) ?? [];

        unset($validated['photos'], $validated['deleted_photos']);

        // Delete specified photos
        if (!empty($deletedPhotos)) {
            foreach ($deletedPhotos as $photoId) {
                $photo = AnnouncementPhoto::find($photoId);
                if ($photo) {
                    Storage::disk('public')->delete($photo->photo_path);
                    $photo->delete();
                }
            }
        }

        $announcement->update($validated);

        // Handle new photo uploads
        if (!empty($photos)) {
            // Get the max order number
            $maxOrder = $announcement->photos()->max('order') ?? -1;
            $order = $maxOrder + 1;

            foreach ($photos as $photo) {
                if ($photo) {
                    $path = $photo->store('announcements', 'public');
                    AnnouncementPhoto::create([
                        'announcement_id' => $announcement->id,
                        'photo_path' => $path,
                        'order' => $order++,
                    ]);
                }
            }
        }

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement)
    {
        if (!Auth::user()->isAdmin()) abort(403);

        // Delete all associated photos from storage
        foreach ($announcement->photos as $photo) {
            Storage::disk('public')->delete($photo->photo_path);
        }

        $announcement->delete();
        return back()->with('success', 'Announcement deleted.');
    }


}
