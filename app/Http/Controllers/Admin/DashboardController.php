<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Poster;
use App\Models\PetRequest;
use App\Models\PetRegistration;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function profile()
    {
        return view('admin.profile', [
            'user' => Auth::user(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'birthday' => 'required|date',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'contact_number' => 'required|string|max:20',
            'emergency_contact' => 'required|string|max:20',
            'street' => 'nullable|string|max:255',
            'barangay' => 'nullable|string|max:255',
            'city_municipality' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'id_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $user->fill($validated);

        if ($request->hasFile('id_photo')) {
            $path = $request->file('id_photo')->store('id_photos', 'public');
            $user->id_photo = $path;
        }

        $user->save();

        return Redirect::route('admin.profile')->with('status', 'profile-updated');
    }


    public function index()
    {
        // Simplified key metrics for dashboard
        $stats = [
            'total_users' => User::count(),
            'verified_users' => User::whereNotNull('email_verified_at')->count(),
            'active_pets' => Pet::whereIn('status', ['impounded', 'adoptable'])->count(), // Active pets admins manage
            'pending_requests' => PetRequest::where('status', 'pending')->count(),
            'total_posters' => Poster::count(), // Lost & found reports
            'pending_registrations' => PetRegistration::where('status', 'pending')->count(), // Pre-registrations awaiting review
            'recent_signups' => User::orderBy('created_at', 'desc')->limit(3)->get(),
        ];

        // Get pending requests for the table
        $pendingRequests = PetRequest::with(['user', 'requestable'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Recent activity feed - combine pets and requests
        $recentPets = Pet::orderBy('created_at', 'desc')->limit(3)->get();
        $recentRequests = PetRequest::with(['user', 'requestable'])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Combine and sort by creation date for activity feed
        $activityFeed = collect([...$recentPets, ...$recentRequests])
            ->sortByDesc('created_at')
            ->take(6);

        $upcomingAnnouncements = Announcement::orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact('stats', 'pendingRequests', 'activityFeed', 'upcomingAnnouncements'));
    }
}
