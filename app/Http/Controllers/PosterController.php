<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosterController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'lost');  // Default to lost; from button/tab
        $query = Poster::where('type', $type)->where('approved', true);
        $posters = $this->applyFilters($query, $request)->paginate(9);
        return view('posters.index', compact('posters', 'type'));
    }

    // Helper for filters (similar to PetController)
    private function applyFilters($query, Request $request)
    {
        if ($request->species) $query->where('species', $request->species);
        if ($request->breed) $query->where('breed', 'like', '%' . $request->breed . '%');
        if ($request->gender) $query->where('gender', $request->gender);
        if ($request->colors) {
            $query->where(function($q) use ($request) {
                foreach ($request->colors as $color) {
                    $q->orWhere('color_markings', 'like', '%' . $color . '%');
                }
            });
        }
        return $query->latest();
    }

    public function create()
    {
        return view('posters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:lost,found',
            'pet_name' => 'required|string|max:100',
            'species' => 'required|string|max:50',
            'breed' => 'required|string|max:100',
            'gender' => 'required|in:male,female,unknown',
            'color_markings' => 'required|string',
            'date_lost_found' => 'required|date',
            'last_seen' => 'nullable|string',  // Required if lost
            'found_at' => 'nullable|string',   // Required if found
            'photo' => 'required|image|max:2048',
            'contact_info' => 'required|string|max:255',
            'reward' => 'nullable|numeric|min:0',
        ]);

        if ($request->type === 'lost' && !$request->last_seen) {
            return back()->withErrors(['last_seen' => 'Last seen is required for lost pets.']);
        }
        if ($request->type === 'found' && !$request->found_at) {
            return back()->withErrors(['found_at' => 'Found at is required for found pets.']);
        }

        $validated['photo'] = $request->file('photo')->store('posters', 'public');
        $validated['user_id'] = Auth::id();
        $validated['approved'] = false;  // Pending admin approval

        Poster::create($validated);

        return redirect()->route('posters.index')->with('success', 'Poster submitted! Awaiting approval.');
    }

    // Show individual poster as digital flyer
    public function show(Poster $poster)
    {
        return view('posters.show', compact('poster'));
    }

    // Admin delete
    public function destroy(Poster $poster)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $poster->delete();
        return back()->with('success', 'Poster deleted.');
    }
}
