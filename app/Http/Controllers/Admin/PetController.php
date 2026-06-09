<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\PetRequest;
use App\Models\PetOwnershipHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->isAdmin()) abort(403);

        $status = $request->get('status');
        // Eager-load the owner, approved requests, and ownership history
        $petsQuery = Pet::query()->with([
            'user',
            'ownershipHistory' => function ($q) {
                $q->orderBy('assigned_date', 'asc');
            },
            'ownershipHistory.user',
            'mostRecentReturn.user',
            'requests' => function ($q) {
                $q->where('status', 'approved')->orderBy('updated_at', 'desc');
            },
            'requests.user',
        ]);
        // If a specific status is requested, filter by it. Otherwise, for
        // the "All Pets" tab we show only the public-facing statuses
        // that should be visible to users: 'impounded' and 'adoptable'.
        if ($status) {
            $petsQuery->where('status', $status);
        } else {
            $petsQuery->whereIn('status', ['impounded', 'adoptable']);
        }
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
            'photo' => 'nullable|image|max:51200',
            'status' => 'required|in:impounded,adoptable',
            'impounded_date' => 'nullable|date|required_if:status,impounded',
            'caught_location' => 'nullable|string|max:255',
            'decision_date' => 'nullable|date|required_if:status,adoptable',
            'adoption_reason' => 'nullable|string|max:255',
            'adoption_reason_other' => 'nullable|string|max:255',
            'adoption_notes' => 'nullable|string',
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

        // Map human-readable adoption reason labels (from form) to DB enum keys
        $labelToKey = [
            'Owner Relocation/Moving' => 'surrendered_by_owner',
            'Owner Illness/Death' => 'surrendered_by_owner',
            'Financial Hardship' => 'other',
            'Landlord/Housing Restriction' => 'other',
            'Lifestyle/Schedule Change' => 'other',
            'Incompatibility with Existing Pets' => 'other',
            'Incompatibility with Children' => 'other',
            'Household Allergies' => 'other',
            'Needs More Space/Exercise' => 'other',
            'Behavioral Issues' => 'other',
        ];

        if (!empty($validated['adoption_reason'])) {
            $val = $validated['adoption_reason'];
            if (array_key_exists($val, $labelToKey)) {
                $mapped = $labelToKey[$val];
                $validated['adoption_reason'] = $mapped;
                // Always store the human-selected label so show pages can display exact choice
                $validated['adoption_reason_other'] = $val;
            } else {
                // If label isn't in mapping, assume it's a human string — store under 'other'
                $validated['adoption_reason_other'] = $val;
                $validated['adoption_reason'] = 'other';
            }
        }

        // Persist adoption fields (they are allowed in $validated and Pet fillable)
        Pet::create($validated);

        return redirect()->route('admin.pets.index')->with('success', 'Pet added.');
    }

    public function show(Pet $pet)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $pet->load([
            'user',
            'requests',
            'ownershipHistory' => function ($q) {
                $q->orderBy('assigned_date', 'asc');
            },
            'ownershipHistory.user',
        ]);
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
            'photo' => 'nullable|image|max:51200',
            'status' => 'required|in:impounded,adoptable,adopted,claimed,unclaimed,unadopted',
            'impounded_date' => 'nullable|date|required_if:status,impounded',
            'decision_date' => 'nullable|date|required_if:status,adoptable',
            'adoption_reason' => 'nullable|string|max:255',
            'adoption_reason_other' => 'nullable|string|max:255',
            'adoption_notes' => 'nullable|string',
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

        // Map human-readable adoption reason labels (from form) to DB enum keys
        $labelToKey = [
            'Owner Relocation/Moving' => 'surrendered_by_owner',
            'Owner Illness/Death' => 'surrendered_by_owner',
            'Financial Hardship' => 'other',
            'Landlord/Housing Restriction' => 'other',
            'Lifestyle/Schedule Change' => 'other',
            'Incompatibility with Existing Pets' => 'other',
            'Incompatibility with Children' => 'other',
            'Household Allergies' => 'other',
            'Needs More Space/Exercise' => 'other',
            'Behavioral Issues' => 'other',
        ];

        if (!empty($validated['adoption_reason'])) {
            $val = $validated['adoption_reason'];
            if (array_key_exists($val, $labelToKey)) {
                $mapped = $labelToKey[$val];
                $validated['adoption_reason'] = $mapped;
                // Always keep the human-selected label so show pages display the exact choice
                $validated['adoption_reason_other'] = $val;
            } else {
                // Not in mapping: store as 'other' and keep human label
                $validated['adoption_reason_other'] = $val;
                $validated['adoption_reason'] = 'other';
            }
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
        return redirect()->route('admin.pets.index')->with('success', 'Pet deleted.');
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

        // Record ownership history
        PetOwnershipHistory::create([
            'pet_id' => $pet->id,
            'user_id' => $approvedRequest->user_id,
            'type' => 'adopted',
            'assigned_date' => now()->toDateString(),
            'adoption_reason' => $pet->adoption_reason,
            'adoption_reason_other' => $pet->adoption_reason_other,
            'adoption_notes' => $pet->adoption_notes,
        ]);

        $approvedRequest->update(['status' => 'completed']);

        // Get all other requests before updating them (to send notifications)
        $otherRequests = PetRequest::where('requestable_id', $pet->id)
            ->where('requestable_type', Pet::class)
            ->where('id', '!=', $approvedRequest->id)
            ->where('status', '!=', 'completed')
            ->get();

        // Auto-deny all other requests for this pet
        foreach ($otherRequests as $otherRequest) {
            $otherRequest->update([
                'status' => 'denied',
                'denial_reason' => 'Other applicant was chosen',
                'denial_type' => 'automatic'
            ]);

            // Notify user that their request was denied
            if ($otherRequest->user) {
                $otherRequest->user->notify(new \App\Notifications\RequestStatusNotification($otherRequest, 'denied'));
            }
        }

        // Notify successful applicant
        if ($approvedRequest->user) {
            $approvedRequest->user->notify(new \App\Notifications\RequestStatusNotification($approvedRequest, 'completed'));
        }

        return back()->with('success', 'Pet marked as adopted and ownership transferred. Other requests have been automatically denied.');
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

        // Record ownership history
        PetOwnershipHistory::create([
            'pet_id' => $pet->id,
            'user_id' => $approvedRequest->user_id,
            'type' => 'claimed',
            'assigned_date' => now()->toDateString(),
            'adoption_reason' => $pet->adoption_reason,
            'adoption_reason_other' => $pet->adoption_reason_other,
            'adoption_notes' => $pet->adoption_notes,
        ]);

        $approvedRequest->update(['status' => 'completed']);

        // Get all other requests before updating them (to send notifications)
        $otherRequests = PetRequest::where('requestable_id', $pet->id)
            ->where('requestable_type', Pet::class)
            ->where('id', '!=', $approvedRequest->id)
            ->where('status', '!=', 'completed')
            ->get();

        // Auto-deny all other requests for this pet
        foreach ($otherRequests as $otherRequest) {
            $otherRequest->update([
                'status' => 'denied',
                'denial_reason' => 'Other applicant was chosen',
                'denial_type' => 'automatic'
            ]);

            // Notify user that their request was denied
            if ($otherRequest->user) {
                $otherRequest->user->notify(new \App\Notifications\RequestStatusNotification($otherRequest, 'denied'));
            }
        }

        // Notify successful claimant
        if ($approvedRequest->user) {
            $approvedRequest->user->notify(new \App\Notifications\RequestStatusNotification($approvedRequest, 'completed'));
        }

        return back()->with('success', 'Pet claimed and ownership transferred to claimant. Other requests have been automatically denied.');
    }

    // Mark pet as returned (brought back by current owner)
    public function markAsReturned(Request $request, Pet $pet)
    {
        if (!Auth::user()->isAdmin()) abort(403);

        $validated = $request->validate([
            'return_reason' => 'required|string|max:255',
            'return_notes' => 'nullable|string|max:500',
        ]);

        // Pet must be in claimed or adopted status to be returned
        if (!in_array($pet->status, ['claimed', 'adopted'])) {
            return back()->with('error', 'Only claimed or adopted pets can be marked as returned.');
        }

        // Pet must have a current owner
        if (!$pet->user_id) {
            return back()->with('error', 'Pet has no current owner to process return.');
        }

        try {
            // Map return reason to enum key
            $returnReasonMap = [
                'Owner Relocation/Moving' => 'owner_relocation',
                'Owner Illness/Death' => 'owner_illness_death',
                'Financial Hardship' => 'financial_hardship',
                'Landlord/Housing Restriction' => 'housing_restriction',
                'Lifestyle/Schedule Change' => 'lifestyle_change',
                'Incompatibility with Existing Pets' => 'incompatibility_pets',
                'Incompatibility with Children' => 'incompatibility_children',
                'Household Allergies' => 'allergies',
                'Needs More Space/Exercise' => 'space_exercise',
                'Behavioral Issues' => 'behavioral_issues',
            ];

            $returnReasonEnum = $returnReasonMap[$validated['return_reason']] ?? 'other';

            // Get the current ownership record
            $currentOwnership = $pet->currentOwnershipRecord()->first();

            if ($currentOwnership) {
                // Update existing ownership record to mark as returned
                $currentOwnership->update([
                    'return_date' => now()->toDateString(),
                    'return_reason' => $returnReasonEnum,
                    'return_reason_other' => $validated['return_reason'],
                    'return_notes' => $validated['return_notes'] ?? null,
                ]);
            } else {
                // For pets adopted/claimed before this feature was added, create a new record
                // Determine type based on current status
                $type = $pet->status === 'claimed' ? 'claimed' : 'adopted';

                PetOwnershipHistory::create([
                    'pet_id' => $pet->id,
                    'user_id' => $pet->user_id,
                    'type' => $type,
                    'assigned_date' => $pet->updated_at->toDateString(), // Use when it was last updated
                    'return_date' => now()->toDateString(),
                    'return_reason' => $returnReasonEnum,
                    'return_reason_other' => $validated['return_reason'],
                    'return_notes' => $validated['return_notes'] ?? null,
                    'adoption_reason' => $pet->adoption_reason,
                    'adoption_reason_other' => $pet->adoption_reason_other,
                    'adoption_notes' => $pet->adoption_notes,
                ]);
            }

            // Mark pet as adoptable again
            $pet->update([
                'status' => 'adoptable',
                'decision_date' => now(),
                'user_id' => null, // Clear current owner
            ]);

            return back()->with('success', 'Pet marked as returned and set to adoptable. Ownership history recorded.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error marking pet as returned: ' . $e->getMessage());
        }
    }

    // Display adoption & claim history (pets with completed requests or expired without)
    public function adoptionClaimHistory(Request $request)
    {
        if (!Auth::user()->isAdmin()) abort(403);

        $status = $request->get('status');

        $petsQuery = Pet::with([
            'user',
            'ownershipHistory' => function ($q) {
                $q->orderBy('assigned_date', 'asc');
            },
            'ownershipHistory.user',
            'mostRecentReturn.user',
            'requests' => function ($q) use ($status) {
                $q->where('status', 'completed')->orderBy('updated_at', 'desc');
                // Filter requests by type to match the tab
                if ($status === 'adopted') {
                    $q->where('type', 'adopt');
                } elseif ($status === 'claimed') {
                    $q->where('type', 'claim');
                } elseif ($status === 'unclaimed') {
                    $q->where('type', 'claim');
                } elseif ($status === 'unadopted') {
                    $q->where('type', 'adopt');
                }
            },
            'requests.user',
        ]);

        // Filter by status
        if ($status === 'unclaimed') {
            // Show both unclaimed and unadopted pets (no owner pets)
            $petsQuery->where(function ($q) {
                $q->where('status', 'unclaimed')
                  ->whereHas('requests', function ($subq) {
                      $subq->where('status', 'completed')->where('type', 'claim');
                  })
                  ->orWhere('status', 'unadopted');
            });
        } elseif ($status === 'adopted') {
            $petsQuery->where('status', 'adopted')
                      ->whereHas('requests', function ($q) {
                          $q->where('status', 'completed')->where('type', 'adopt');
                      });
        } elseif ($status === 'claimed') {
            $petsQuery->where('status', 'claimed')
                      ->whereHas('requests', function ($q) {
                          $q->where('status', 'completed')->where('type', 'claim');
                      });
        } elseif ($status === 'all') {
            // For "All History" tab: pets with any completed requests or unadopted
            $petsQuery->where(function ($q) {
                $q->whereHas('requests', function ($subq) {
                    $subq->where('status', 'completed');
                })->orWhere('status', 'unadopted');
            });
        } else {
            // Default: all with completed requests
            $petsQuery->whereHas('requests', function ($q) {
                $q->where('status', 'completed');
            });
        }

        $petsQuery->orderBy('updated_at', 'desc');
        $pets = $petsQuery->paginate(15)->withQueryString();

        return view('admin.pets.adoption-claim-history', [
            'pets' => $pets,
        ]);
    }
}
