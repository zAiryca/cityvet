<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\PetRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $petRegistrations = Auth::user()->petRegistrations()->get();
        return view('user.pet-registrations.index', compact('petRegistrations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.pet-registrations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pet_name' => 'required|string|max:255',
            'species' => 'required|in:Canine,Feline',
            'breed' => 'required|string|max:255',
            'birthday' => 'nullable|date',
            'gender' => 'required|in:male,female,unknown',
            'color_markings' => 'nullable|array',
            'color_markings.*' => 'string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('pet-registrations', 'public');
        }

        PetRegistration::create([
            'user_id' => Auth::id(),
            'pet_name' => $request->pet_name,
            'species' => $request->species,
            'breed' => $request->breed,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'color_markings' => $request->color_markings,
            'description' => $request->description,
            'photo' => $photoPath,
            'status' => 'pending',
        ]);

        return redirect()->route('pet-registrations.index')->with('success', 'Pet registration submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $petRegistration = PetRegistration::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('user.pet-registrations.show', compact('petRegistration'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $petRegistration = PetRegistration::where('id', $id)->where('user_id', Auth::id())->where('status', 'pending')->firstOrFail();
        return view('user.pet-registrations.edit', compact('petRegistration'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $petRegistration = PetRegistration::where('id', $id)->where('user_id', Auth::id())->where('status', 'pending')->firstOrFail();

        $request->validate([
            'pet_name' => 'required|string|max:255',
            'species' => 'required|in:Canine,Feline',
            'breed' => 'required|string|max:255',
            'birthday' => 'nullable|date',
            'gender' => 'required|in:male,female,unknown',
            'color_markings' => 'nullable|array',
            'color_markings.*' => 'string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = $petRegistration->photo;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('pet-registrations', 'public');
        }

        $petRegistration->update([
            'pet_name' => $request->pet_name,
            'species' => $request->species,
            'breed' => $request->breed,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'color_markings' => $request->color_markings,
            'description' => $request->description,
            'photo' => $photoPath,
        ]);

        return redirect()->route('pet-registrations.index')->with('success', 'Pet registration updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $petRegistration = PetRegistration::where('id', $id)->where('user_id', Auth::id())->where('status', 'pending')->firstOrFail();
        $petRegistration->delete();

        return redirect()->route('pet-registrations.index')->with('success', 'Pet registration deleted successfully!');
    }

    /**
     * Approve a pet registration (Admin only)
     */
    public function approve(string $id)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $petRegistration = PetRegistration::findOrFail($id);
        $petRegistration->update(['status' => 'registered']);

        // Create corresponding record in pets table
        Pet::create([
            'user_id' => $petRegistration->user_id,
            'name' => $petRegistration->pet_name,
            'species' => $petRegistration->species,
            'breed' => $petRegistration->breed,
            'estimated_age_years' => $petRegistration->birthday ? now()->diffInYears($petRegistration->birthday) : null,
            'estimated_age_months' => $petRegistration->birthday ? now()->diffInMonths($petRegistration->birthday) % 12 : null,
            'gender' => $petRegistration->gender,
            'color_markings' => is_array($petRegistration->color_markings) ? implode(',', $petRegistration->color_markings) : $petRegistration->color_markings,
            'description' => $petRegistration->description,
            'photo' => $petRegistration->photo,
            'status' => 'registered',
            'registration_status' => 'approved',
        ]);

        return back()->with('success', 'Pet registration approved successfully!');
    }

    /**
     * Deny a pet registration (Admin only)
     */
    public function deny(string $id)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $petRegistration = PetRegistration::findOrFail($id);
        $petRegistration->update(['status' => 'denied']);

        return back()->with('success', 'Pet registration denied.');
    }
}
