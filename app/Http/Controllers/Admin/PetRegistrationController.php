<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PetRegistration;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PetRegistrationController extends Controller
{
    public function index(Request $request)
    {
        $query = PetRegistration::with('user');

        // Apply filters
        if ($request->has('registration_status') && $request->registration_status) {
            $query->where('status', $request->registration_status);
        }

        if ($request->has('search') && $request->search) {
            $query->where('pet_name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('species') && $request->species) {
            $query->where('species', $request->species);
        }

        if ($request->has('breed') && $request->breed) {
            $query->where('breed', $request->breed);
        }

        if ($request->has('gender') && $request->gender) {
            $query->where('gender', $request->gender);
        }

        if ($request->has('selectedColors') && is_array($request->selectedColors)) {
            foreach ($request->selectedColors as $color) {
                $query->whereJsonContains('color_markings', $color);
            }
        }

        $pets = $query->paginate(10);

        $currentRegistrationStatus = $request->get('registration_status');

        return view('admin.pet-registrations.index', compact('pets', 'currentRegistrationStatus'));
    }

    public function show(PetRegistration $pet)
    {
        return view('admin.pet-registrations.show', compact('pet'));
    }

    public function approve(PetRegistration $pet)
    {
        if ($pet->status !== 'pending') {
            return redirect()->back()->with('error', 'Pet registration is not pending.');
        }

        // Calculate age from birthday
        $birthday = Carbon::parse($pet->birthday);
        $now = Carbon::now();
        $ageInMonths = $birthday->diffInMonths($now);
        $estimatedAgeYears = floor($ageInMonths / 12);
        $estimatedAgeMonths = $ageInMonths % 12;

        // Create the pet record
        Pet::create([
            'user_id' => $pet->user_id,
            'name' => $pet->pet_name,
            'species' => $pet->species,
            'breed' => $pet->breed,
            'estimated_age_years' => $estimatedAgeYears,
            'estimated_age_months' => $estimatedAgeMonths,
            'gender' => $pet->gender,
            'color_markings' => is_array($pet->color_markings) ? implode(', ', $pet->color_markings) : $pet->color_markings,
            'description' => $pet->description,
            'photo' => $pet->photo,
            'status' => 'registered',
        ]);

        // Update registration status
        $pet->update(['status' => 'registered']);

        return redirect()->route('admin.pet-registrations.index')->with('success', 'Pet registration approved and pet record created.');
    }

    public function deny(PetRegistration $pet)
    {
        if ($pet->status !== 'pending') {
            return redirect()->back()->with('error', 'Pet registration is not pending.');
        }

        $pet->update(['status' => 'denied']);

        return redirect()->route('admin.pet-registrations.index')->with('success', 'Pet registration denied.');
    }

    public function destroy(PetRegistration $pet)
    {
        // Delete photo if exists
        if ($pet->photo && Storage::disk('public')->exists($pet->photo)) {
            Storage::disk('public')->delete($pet->photo);
        }

        $pet->delete();

        return redirect()->route('admin.pet-registrations.index')->with('success', 'Pet registration deleted.');
    }
}
