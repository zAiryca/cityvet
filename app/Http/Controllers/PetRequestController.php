<?php

namespace App\Http\Controllers;

use App\Models\PetRequest;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetRequestController extends Controller
{
    public function index()
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $requests = PetRequest::with(['pet', 'user'])->where('status', 'pending')->paginate(10);
        return view('admin.requests.index', compact('requests'));
    }

    public function update(Request $request, PetRequest $petRequest)
    {
        if (!Auth::user()->isAdmin()) abort(403);
        $status = $request->status;  // 'approved' or 'rejected'
        $petRequest->update(['status' => $status]);

        if ($status === 'approved') {
            $pet = $petRequest->pet;
            if ($petRequest->type === 'claim') {
                $pet->update(['status' => 'claimed', 'user_id' => $petRequest->user_id]);
            } elseif ($petRequest->type === 'adopt') {
                $pet->update(['status' => 'adopted', 'user_id' => $petRequest->user_id, 'urgent_deadline' => null]);
            }
        }

        return back()->with('success', 'Request ' . $status . '.');
    }
}
