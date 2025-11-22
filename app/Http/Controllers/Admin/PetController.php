<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\PetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->isAdmin()) abort(403);

        $status = $request->get('status');
        // Eager-load the owner and any approved requests (with their users) to show requester info in the index
        $petsQuery = Pet::query()->with([
            'user',
            'requests' => function ($q) {
                $q->where('status', 'approved')->orderBy('updated_at', 'desc');
            },
            'requests.user',
        ]);
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
    // Note: urgent_deadline feature removed; no setUrgent action.

    // Mark pet as adopted
    public function markAsAdopted(Request $request, Pet $pet)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $petRequestId = $request->input('pet_request_id');

        if ($petRequestId) {
            $approvedRequest = PetRequest::where('id', $petRequestId)
                ->where('requestable_type', Pet::class)
                ->where('requestable_id', $pet->id)
                ->where('type', 'adopt')
                ->where('status', 'approved')
                ->first();
        } else {
            $approvedRequest = $pet->requests()
                ->where('type', 'adopt')
                ->where('status', 'approved')
                ->first();
        }

        if (!$approvedRequest) {
            return back()->with('error', 'No approved adoption request found for this pet.');
        }

        $pet->update([
            'status' => 'adopted',
            'user_id' => $approvedRequest->user_id,
        ]);

        $approvedRequest->update(['status' => 'completed']);

        return back()->with('success', 'Pet marked as adopted and ownership transferred.');
    }

    // Mark pet as claimed
    public function markAsClaimed(Request $request, Pet $pet)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $petRequestId = $request->input('pet_request_id');

        if ($petRequestId) {
            $approvedRequest = PetRequest::where('id', $petRequestId)
                ->where('requestable_type', Pet::class)
                ->where('requestable_id', $pet->id)
                ->where('type', 'claim')
                ->where('status', 'approved')
                ->first();
        } else {
            $approvedRequest = $pet->requests()
                ->where('type', 'claim')
                ->where('status', 'approved')
                ->first();
        }

        if (!$approvedRequest) {
            return back()->with('error', 'No approved claim request found for this pet.');
        }

        $pet->update([
            'status' => 'claimed',
            'user_id' => $approvedRequest->user_id
        ]);

        $approvedRequest->update(['status' => 'completed']);

        return back()->with('success', 'Pet claimed and ownership transferred to claimant.');
    }

    // Display adoption & claim history (only pets with completed requests)
    public function adoptionClaimHistory(Request $request)
    {
        if (!Auth::user()->isAdmin()) abort(403);

        $status = $request->get('status');

        // Base query: only pets that have at least one completed request
        $petsQuery = Pet::whereHas('requests', function ($q) use ($request) {
            $q->where('status', 'completed');
            // Optional filter by type: if status param is 'adopted' or 'claimed', map to request type
            $filter = $request->get('status');
            if ($filter === 'adopted') {
                $q->where('type', 'adopt');
            } elseif ($filter === 'claimed') {
                $q->where('type', 'claim');
            }
        })
        ->with([
            'user',
            'requests' => function ($q) use ($request) {
                $q->where('status', 'completed')->orderBy('updated_at', 'desc');
                $filter = $request->get('status');
                if ($filter === 'adopted') {
                    $q->where('type', 'adopt');
                } elseif ($filter === 'claimed') {
                    $q->where('type', 'claim');
                }
            },
            'requests.user',
        ])
        ->orderBy('updated_at', 'desc');

        $pets = $petsQuery->paginate(15)->withQueryString();

        return view('admin.pets.adoption-claim-history', [
            'pets' => $pets,
        ]);
    }
}
