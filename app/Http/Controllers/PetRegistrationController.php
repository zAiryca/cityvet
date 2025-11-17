<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Auth::user()->pets()->get();
        return view('user.pet-registrations.index', compact('pets'));
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
            'name' => 'required|string|max:255',
            'species' => 'required|in:Canine,Feline',
            'breed' => 'required|string|max:255',
            'estimated_age_years' => 'nullable|integer|min:0|max:20',
            'estimated_age_months' => 'nullable|integer|min:0|max:11',
            'gender' => 'required|in:male,female,unknown',
            'color_markings' => 'nullable|array',
            'color_markings.*' => 'string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('pets', 'public');
        }

        $colorMarkings = '';
        if ($request->has('color_markings') && is_array($request->color_markings)) {
            $colorMarkings = implode(',', $request->color_markings);
        }

        Pet::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'species' => $request->species,
            'breed' => $request->breed,
            'estimated_age_years' => $request->estimated_age_years,
            'estimated_age_months' => $request->estimated_age_months,
            'gender' => $request->gender,
            'color_markings' => $colorMarkings,
            'description' => $request->description,
            'photo' => $photoPath,
            'status' => 'pre-registered',
            'registration_status' => 'pre-registered',
        ]);

        return redirect()->route('pet-registrations.index')->with('success', 'Pet pre-registration submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pet = Pet::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('user.pet-registrations.show', compact('pet'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pet = Pet::where('id', $id)->where('user_id', Auth::id())->where('registration_status', 'pre-registered')->firstOrFail();
        return view('user.pet-registrations.edit', compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pet = Pet::where('id', $id)->where('user_id', Auth::id())->where('registration_status', 'pre-registered')->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|in:Canine,Feline',
            'breed' => 'required|string|max:255',
            'estimated_age_years' => 'nullable|integer|min:0|max:20',
            'estimated_age_months' => 'nullable|integer|min:0|max:11',
            'gender' => 'required|in:male,female,unknown',
            'color_markings' => 'nullable|array',
            'color_markings.*' => 'string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = $pet->photo;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('pets', 'public');
        }

        $colorMarkings = '';
        if ($request->has('color_markings') && is_array($request->color_markings)) {
            $colorMarkings = implode(',', $request->color_markings);
        }

        $pet->update([
            'name' => $request->name,
            'species' => $request->species,
            'breed' => $request->breed,
            'estimated_age_years' => $request->estimated_age_years,
            'estimated_age_months' => $request->estimated_age_months,
            'gender' => $request->gender,
            'color_markings' => $colorMarkings,
            'description' => $request->description,
            'photo' => $photoPath,
        ]);

        return redirect()->route('pet-registrations.index')->with('success', 'Pet pre-registration updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pet = Pet::where('id', $id)->where('user_id', Auth::id())->where('registration_status', 'pre-registered')->firstOrFail();
        $pet->delete();

        return redirect()->route('pet-registrations.index')->with('success', 'Pet pre-registration deleted successfully!');
    }

    /**
     * Approve a pet registration (Admin only)
     */
    public function approve(string $id)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $pet = Pet::findOrFail($id);
        $pet->update([
            'registration_status' => 'approved',
            'status' => 'registered'
        ]);

        return back()->with('success', 'Pet registration approved successfully!');
    }

    /**
     * Deny a pet registration (Admin only)
     */
    public function deny(string $id)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $pet = Pet::findOrFail($id);
        $pet->update(['registration_status' => 'denied']);

        return back()->with('success', 'Pet registration denied.');
    }
}
