<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $pets = Pet::with('user')->paginate(10);
        return view('admin.pets.index', compact('pets'));
    }

    public function create()
    {
        if (!Auth::user()->isAdmin()) abort(403);
        return view('admin.pets.create');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'species' => 'required|string|max:50',
            'breed' => 'required|string|max:100',
            'gender' => 'required|in:male,female,unknown',
            'color_markings' => 'required|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'status' => 'required|in:registered,impounded,adoptable,adopted,claimed',
            'impounded_date' => 'nullable|date|required_if:status,impounded,adoptable',
            'remaining_days' => 'nullable|integer|min:0',
            'user_id' => 'nullable|exists:users,id',  // Optional owner
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('pets', 'public');
        }

        Pet::create($validated);

        return redirect()->route('admin.pets.index')->with('success', 'Pet added.');
    }

    public function show(Pet $pet)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $pet->load('user', 'requests');
        return view('admin.pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        return view('admin.pets.edit', compact('pet'));
    }

    public function update(Request $request, Pet $pet)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'species' => 'required|string|max:50',
            'breed' => 'required|string|max:100',
            'gender' => 'required|in:male,female,unknown',
            'color_markings' => 'required|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'status' => 'required|in:registered,impounded,adoptable,adopted,claimed',
            'impounded_date' => 'nullable|date|required_if:status,impounded,adoptable',
            'remaining_days' => 'nullable|integer|min:0',
            'user_id' => 'nullable|exists:users,id',
            'urgent_deadline' => 'nullable|date|after:now',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists (optional: add Storage::delete)
            if ($pet->photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($pet->photo);
            }
            $validated['photo'] = $request->file('photo')->store('pets', 'public');
        }

        $pet->update($validated);

        return redirect()->route('admin.pets.index')->with('success', 'Pet updated.');
    }

    public function destroy(Pet $pet)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        if ($pet->photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($pet->photo);
        }
        $pet->delete();
        return back()->with('success', 'Pet deleted.');
    }

    // Custom: Set urgent deadline (from routes)
    public function setUrgent(Request $request, Pet $pet)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $request->validate(['urgent_deadline' => 'required|date|after:now']);
        $pet->update([
            'status' => 'adoptable',
            'urgent_deadline' => $request->urgent_deadline,
        ]);
        return back()->with('success', 'Pet marked as urgent with deadline.');
    }
}
