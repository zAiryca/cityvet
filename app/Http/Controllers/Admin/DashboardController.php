<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Poster;
use App\Models\PetRequest;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'verified_users' => User::whereNotNull('email_verified_at')->count(),
            'unverified_users' => User::whereNull('email_verified_at')->count(),
            'admin_users' => User::where('role', 'admin')->count(),
            'recent_signups' => User::orderBy('created_at', 'desc')->limit(5)->get(),
            'total_pets' => Pet::count(),
            'impounded' => Pet::where('status', 'impounded')->count(),
            'claimed' => Pet::where('status', 'claimed')->count(),
            'adopted' => Pet::where('status', 'adopted')->count(),
            'adoptable' => Pet::where('status', 'adoptable')->count(),
            'pending_requests' => PetRequest::where('status', 'pending')->count(),
            'pre_registered_pets' => Pet::where('registration_status', 'pre-registered')->count(),
        ];

        $recentPets = Pet::orderBy('created_at', 'desc')->limit(5)->get();

        $upcomingAnnouncements = Announcement::upcoming()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPets', 'upcomingAnnouncements'));
    }
}
