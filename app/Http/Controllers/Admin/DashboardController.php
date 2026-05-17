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

class DashboardController extends Controller
{
    public function profile()
    {
        return view('admin.profile', [
            'user' => Auth::user(),
        ]);
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
