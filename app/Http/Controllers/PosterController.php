<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PosterController extends Controller
{
    public function index(Request $request)
    {
        // This method is now handled by Livewire component
        return view('posters.index');
    }

    public function create()
    {
        return view('posters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:lost,found',
            'pet_name' => 'nullable|string|max:100',
            'species' => 'required|string|max:50',
            'breed' => 'required|string|max:100',
            'gender' => 'required|in:male,female,unknown',
            'color_markings' => 'nullable|array',
            'color_markings.*' => 'string',
            'date_lost_found' => 'required|date',
            'description' => 'nullable|string',
            'uploader_comments' => 'nullable|string',
            'last_seen' => 'nullable|string',
            'found_at' => 'nullable|string',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:51200',
            'photo' => 'nullable|image|max:51200|required_without:photos',
            'video' => 'nullable|file|mimes:mp4,mov,avi,webm,mkv|max:102400',
            'contact_info' => 'required|string|max:255',
            'reward' => 'nullable|numeric|min:0',
            'social_media_links' => 'nullable|array',
            'social_media_links.*' => 'nullable|url|max:500',
        ]);

        // Convert color markings array to comma-separated string
        if (isset($validated['color_markings']) && is_array($validated['color_markings'])) {
            $validated['color_markings'] = implode(',', $validated['color_markings']);
        }

        // Filter out empty social media links
        if (isset($validated['social_media_links'])) {
            $validated['social_media_links'] = array_filter($validated['social_media_links']);
            if (empty($validated['social_media_links'])) {
                $validated['social_media_links'] = null;
            }
        }

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoPaths[] = $photo->store('posters', 'public');
            }
        } elseif ($request->hasFile('photo')) {
            $photoPaths[] = $request->file('photo')->store('posters', 'public');
        }

        if (!empty($photoPaths)) {
            $validated['photos'] = $photoPaths;
            $validated['photo'] = $photoPaths[0];
        }


        // Video replacement / removal handling
        if ($request->hasFile('video')) {
            $validated['video'] = $request->file('video')->store('posters', 'public');
        }

        $validated['user_id'] = Auth::id();
        $validated['approved'] = true;  // Direct posting without review
        $validated['status'] = 'active';  // New posters are active by default

        Poster::create($validated);

        return redirect()->route('user.posters')->with('success', 'Poster posted successfully.');
    }

    // Show individual poster as digital flyer
    public function show(Poster $poster)
    {
        return view('posters.show', compact('poster'));
    }

    public function edit(Poster $poster)
    {
        // Ensure user owns the poster or is admin
        if ($poster->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }
        return view('posters.edit', compact('poster'));
    }

    public function update(Request $request, Poster $poster)
    {
        // Ensure user owns the poster or is admin
        if ($poster->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $validated = $request->validate([
            'type' => 'required|in:lost,found',
            'pet_name' => 'nullable|string|max:100',
            'species' => 'required|string|max:50',
            'breed' => 'required|string|max:100',
            'gender' => 'required|in:male,female,unknown',
            'color_markings' => 'nullable|array',
            'color_markings.*' => 'string',
            'date_lost_found' => 'required|date',
            'description' => 'nullable|string',
            'uploader_comments' => 'nullable|string',
            'last_seen' => 'nullable|string',
            'found_at' => 'nullable|string',
            'existing_photos' => 'nullable|array',
            'existing_photos.*' => 'string',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif|max:51200',
            'photo' => 'nullable|image|max:51200',
            'video' => 'nullable|file|mimes:mp4,mov,avi,webm,mkv|max:102400',
            'contact_info' => 'required|string|max:255',
            'reward' => 'nullable|numeric|min:0',
            'social_media_links' => 'nullable|array',
            'social_media_links.*' => 'nullable|url|max:500',
        ]);

        // Convert color markings array to comma-separated string
        if (isset($validated['color_markings']) && is_array($validated['color_markings'])) {
            $validated['color_markings'] = implode(',', $validated['color_markings']);
        }

        // Filter out empty social media links
        if (isset($validated['social_media_links'])) {
            $validated['social_media_links'] = array_filter($validated['social_media_links']);
            if (empty($validated['social_media_links'])) {
                $validated['social_media_links'] = null;
            }
        }

        if ($request->has('existing_photos_present')) {
            $photoPaths = $validated['existing_photos'] ?? [];
        } else {
            $photoPaths = $poster->photos ?? [];
        }

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoPaths[] = $photo->store('posters', 'public');
            }
        }

        if ($request->hasFile('photo')) {
            $newPhotoPath = $request->file('photo')->store('posters', 'public');
            $photoPaths[] = $newPhotoPath;
            $validated['photo'] = $newPhotoPath;
        }

        if ($request->boolean('remove_existing_video')) {
            if ($poster->video) {
                Storage::disk('public')->delete($poster->video);
            }
            $validated['video'] = null;
        }

        if ($request->hasFile('video')) {
            if ($poster->video) {
                Storage::disk('public')->delete($poster->video);
            }
            $validated['video'] = $request->file('video')->store('posters', 'public');
        }

        $validated['photos'] = array_values($photoPaths);
        if (!empty($photoPaths)) {
            $validated['photo'] = $validated['photo'] ?? $photoPaths[0];
        } else {
            $validated['photo'] = null;
        }

        $poster->update($validated);

        return redirect()->route('user.posters')->with('success', 'Poster updated successfully.');
    }

    public function reunite(Request $request, Poster $poster)
    {
        // Ensure user owns the poster or is admin
        if ($poster->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $poster->update(['status' => 'reunited']);

        return redirect()->route('user.posters')->with('success', 'Poster marked as reunited.');
    }

    // Admin delete
    public function destroy(Poster $poster)
    {
        // Ensure user owns the poster or is admin
        if ($poster->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }
        $poster->delete();

        // Redirect based on user role
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.posters.index')->with('success', 'Poster deleted.');
        } else {
            return back()->with('success', 'Poster deleted.');
        }
    }

    /**
     * Stream poster video with support for HTTP Range requests.
     */
    public function video(Request $request, Poster $poster)
    {
        $filePath = storage_path('app/public/' . $poster->video);
        if (! $poster->video || ! file_exists($filePath)) {
            abort(404);
        }

        $size = filesize($filePath);
        $mime = mime_content_type($filePath) ?: 'application/octet-stream';
        $headers = [
            'Content-Type' => $mime,
            'Accept-Ranges' => 'bytes',
        ];

        $rangeHeader = $request->header('Range');
        if ($rangeHeader && preg_match('/bytes=(\d*)-(\d*)/', $rangeHeader, $matches)) {
            $start = $matches[1] === '' ? 0 : intval($matches[1]);
            $end = $matches[2] === '' ? $size - 1 : intval($matches[2]);

            if ($start > $end || $end >= $size) {
                abort(416);
            }

            $length = $end - $start + 1;
            $headers['Content-Range'] = "bytes {$start}-{$end}/{$size}";
            $headers['Content-Length'] = $length;
            $headers['Accept-Ranges'] = 'bytes';

            $stream = fopen($filePath, 'rb');
            fseek($stream, $start);

            return response()->stream(function () use ($stream, $end) {
                $bufferSize = 1024 * 8;
                while (!feof($stream) && ftell($stream) <= $end) {
                    $read = $bufferSize;
                    if (ftell($stream) + $read > $end) {
                        $read = $end - ftell($stream) + 1;
                    }
                    echo fread($stream, $read);
                    flush();
                }
                fclose($stream);
            }, 206, $headers);
        }

        return response()->file($filePath, $headers);
    }
}
