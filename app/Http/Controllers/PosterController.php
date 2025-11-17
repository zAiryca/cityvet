<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'photo' => 'required|image|max:10240',
            'contact_info' => 'required|string|max:255',
            'reward' => 'nullable|numeric|min:0',
        ]);

        // Convert color markings array to comma-separated string
        if (isset($validated['color_markings']) && is_array($validated['color_markings'])) {
            $validated['color_markings'] = implode(',', $validated['color_markings']);
        }

        $validated['photo'] = $request->file('photo')->store('posters', 'public');
        $validated['user_id'] = Auth::id();
        $validated['approved'] = true;  // Direct posting without review
        $validated['status'] = 'active';  // New posters are active by default

        Poster::create($validated);

        return redirect()->route('posters.index')->with('success', 'Poster posted successfully.');
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
            'photo' => 'nullable|image|max:10240',
            'contact_info' => 'required|string|max:255',
            'reward' => 'nullable|numeric|min:0',
        ]);

        // Convert color markings array to comma-separated string
        if (isset($validated['color_markings']) && is_array($validated['color_markings'])) {
            $validated['color_markings'] = implode(',', $validated['color_markings']);
        }

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('posters', 'public');
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
        return back()->with('success', 'Poster deleted.');
    }
}
