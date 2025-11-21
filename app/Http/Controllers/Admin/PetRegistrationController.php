<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PetRegistration;
use Illuminate\Http\Request;

class PetRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PetRegistration::query();

        // Filter by registration status
        if ($request->has('registration_status') && $request->registration_status) {
            $query->where('status', $request->registration_status);
        }

        // Search by pet ID
        if ($request->has('search') && $request->search) {
            $query->where('id', 'like', '%' . $request->search . '%');
        }

        // Filter by species
        if ($request->has('species') && $request->species) {
            $query->where('species', $request->species);
        }

        // Filter by breed
        if ($request->has('breed') && $request->breed) {
            $query->where('breed', $request->breed);
        }

        // Filter by gender
        if ($request->has('gender') && $request->gender) {
            $query->where('gender', $request->gender);
        }

        // Filter by color markings
        if ($request->has('selectedColors') && is_array($request->selectedColors)) {
            $query->where(function ($q) use ($request) {
                foreach ($request->selectedColors as $color) {
                    $q->orWhere('color_markings', 'like', '%' . $color . '%');
                }
            });
        }

        $pets = $query->paginate(10);

        $currentRegistrationStatus = $request->get('registration_status');
        $search = $request->get('search');
        $species = $request->get('species');
        $breed = $request->get('breed');
        $gender = $request->get('gender');
        $selectedColors = $request->get('selectedColors', []);

        return view('admin.pet-registrations.index', compact(
            'pets',
            'currentRegistrationStatus',
            'search',
            'species',
            'breed',
            'gender',
            'selectedColors'
        ));
    }

    /**
     * Display the specified resource.
     */
    public function show(PetRegistration $pet_registration)
    {
        return view('admin.pet-registrations.show', compact('pet_registration'));
    }

    /**
     * Approve a pet registration (Admin only)
     */
    public function approve(PetRegistration $pet_registration)
    {
        $pet_registration->update(['status' => 'registered']);

        return back()->with('success', 'Pet registration approved successfully!');
    }

    /**
     * Deny a pet registration (Admin only)
     */
    public function deny(PetRegistration $pet_registration)
    {
        // Only allow denying pending registrations
        if ($pet_registration->status !== 'pending') {
            return back()->with('error', 'Only pending registrations can be denied.');
        }

        $pet_registration->update(['status' => 'denied']);

        return back()->with('success', 'Pet registration denied.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PetRegistration $pet_registration)
    {
        $pet_registration->delete();

        return back()->with('success', 'Pet registration deleted successfully!');
    }
}
