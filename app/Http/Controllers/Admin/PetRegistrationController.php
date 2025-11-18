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

    public function show(PetRegistration $pet_registration)
    {
        return view('admin.pet-registrations.show', compact('pet_registration'));
    }

    public function approve(PetRegistration $pet_registration)
    {
        if ($pet_registration->status !== 'pending') {
            return redirect()->back()->with('error', 'Pet registration is not pending.');
        }

        // Calculate age from birthday
        $birthday = Carbon::parse($pet_registration->birthday);
        $now = Carbon::now();
        $ageInMonths = $birthday->diffInMonths($now);
        $estimatedAgeYears = floor($ageInMonths / 12);
        $estimatedAgeMonths = $ageInMonths % 12;

        // Create the pet record
        Pet::create([
            'user_id' => $pet_registration->user_id,
            'name' => $pet_registration->pet_name,
            'species' => $pet_registration->species,
            'breed' => $pet_registration->breed,
            'estimated_age_years' => $estimatedAgeYears,
            'estimated_age_months' => $estimatedAgeMonths,
            'gender' => $pet_registration->gender,
            'color_markings' => is_array($pet_registration->color_markings) ? implode(', ', $pet_registration->color_markings) : $pet_registration->color_markings,
            'description' => $pet_registration->description,
            'photo' => $pet_registration->photo,
            'status' => 'registered',
        ]);

        // Update registration status
        $pet_registration->update(['status' => 'registered']);

        return redirect()->route('admin.pet-registrations.index')->with('success', 'Pet registration approved and pet record created.');
    }

    public function deny(PetRegistration $pet_registration)
    {
        if ($pet_registration->status !== 'pending') {
            return redirect()->back()->with('error', 'Pet registration is not pending.');
        }

        $pet_registration->update(['status' => 'denied']);

        return redirect()->route('admin.pet-registrations.index')->with('success', 'Pet registration denied.');
    }

    public function destroy(PetRegistration $pet_registration)
    {
        // Delete photo if exists
        if ($pet_registration->photo && Storage::disk('public')->exists($pet_registration->photo)) {
            Storage::disk('public')->delete($pet_registration->photo);
        }

        $pet_registration->delete();

        return redirect()->route('admin.pet-registrations.index')->with('success', 'Pet registration deleted.');
    }
}
