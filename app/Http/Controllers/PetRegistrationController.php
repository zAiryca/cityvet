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
        $pets = Auth::user()->pets()->where('registration_status', 'pre-registered')->get();
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
            'species' => 'required|in:Feline,Canine',
            'breed' => 'required|string|max:255',
            'birth_date' => 'required|date|before:today',
            'gender' => 'required|in:Male,Female',
            'color_markings' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('pets', 'public');
        }

        Pet::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'species' => $request->species,
            'breed' => $request->breed,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'color_markings' => $request->color_markings,
            'description' => $request->description,
            'photo' => $photoPath,
            'status' => 'registered', // Will be set to registered once approved
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
            'species' => 'required|in:Feline,Canine',
            'breed' => 'required|string|max:255',
            'birth_date' => 'required|date|before:today',
            'gender' => 'required|in:Male,Female',
            'color_markings' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = $pet->photo;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('pets', 'public');
        }

        $pet->update([
            'name' => $request->name,
            'species' => $request->species,
            'breed' => $request->breed,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'color_markings' => $request->color_markings,
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
}
