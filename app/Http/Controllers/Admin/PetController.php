<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->isAdmin()) abort(403);

        $status = $request->get('status');
        $petsQuery = Pet::query()->with('user');
        $petsQuery->when($status, function ($query, $status) {
            return $query->where('status', $status);
        });
        $pets = $petsQuery->paginate(10);

        return view('admin.pets.index', [
            'pets' => $pets,
            'currentStatus' => $status,
        ]);
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
            'species' => 'required|string|max:50',
            'breed' => 'required|string|max:100',
            'estimated_age_years' => 'nullable|integer|min:0|max:20',
            'estimated_age_months' => 'nullable|integer|min:0|max:11',
            'gender' => 'required|in:male,female,unknown',
            'color_markings' => 'nullable|array',
            'color_markings.*' => 'string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:10240',
            'status' => 'required|in:impounded,adoptable',
            'impounded_date' => 'nullable|date|required_if:status,impounded',
            'caught_location' => 'nullable|string|max:255',
            'decision_date' => 'nullable|date|required_if:status,adoptable',
            'remaining_days' => 'nullable|integer|min:0',
            'user_id' => 'nullable|exists:users,id',  // Optional owner
        ]);

        if ($request->has('color_markings') && is_array($request->color_markings)) {
            $validated['color_markings'] = implode(',', $request->color_markings);
        } else {
            $validated['color_markings'] = '';
        }

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
            'species' => 'required|string|max:50',
            'breed' => 'required|string|max:100',
            'estimated_age_years' => 'nullable|integer|min:0|max:20',
            'estimated_age_months' => 'nullable|integer|min:0|max:11',
            'gender' => 'required|in:male,female,unknown',
            'color_markings' => 'nullable|array',
            'color_markings.*' => 'string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:10240',
            'status' => 'required|in:impounded,adoptable,adopted,claimed,unclaimed,unadopted',
            'impounded_date' => 'nullable|date|required_if:status,impounded',
            'caught_location' => 'nullable|string|max:255',
            'remaining_days' => 'nullable|integer|min:0',
            'user_id' => 'nullable|exists:users,id',
        ]);

        if ($request->has('color_markings') && is_array($request->color_markings)) {
            $validated['color_markings'] = implode(',', $request->color_markings);
        } else {
            $validated['color_markings'] = '';
        }

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

    // Mark pet as adopted
    public function markAsAdopted(Pet $pet)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $pet->update(['status' => 'adopted']);
        return back()->with('success', 'Pet marked as adopted.');
    }

    // Mark pet as claimed
    public function markAsClaimed(Pet $pet)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $pet->update(['status' => 'claimed']);
        return back()->with('success', 'Pet marked as claimed.');
    }
}
