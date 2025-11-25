<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PosterController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PetRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PetController as AdminPetController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PetRegistrationController;





Route::middleware('setlocale')->group(function () {
    // Pet browsing routes (Viewing)
    Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
    Route::get('/pets/{pet}', [PetController::class, 'show'])->name('pets.show');
    // 💡 Security Fix: The 'pets.request' route is removed from here
    // to ensure it is only accessible to authenticated users (see line 100).

    // Language switcher
    Route::get('/lang/{locale}', function ($locale) {
        if (in_array($locale, ['en', 'fil'])) {
            session(['locale' => $locale]);
            app()->setLocale($locale);
        }
        return redirect()->back();
    })->name('lang.switch');

    // Public routes (no auth needed)
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/impounded', [PetController::class, 'impounded'])->name('pets.impounded');
    Route::get('/adoptable', [PetController::class, 'adoptable'])->name('pets.adoptable');
    Route::get('/lost-found', [PosterController::class, 'index'])->name('posters.index');
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/{announcement}', [AnnouncementController::class, 'show'])->name('announcements.show');
    Route::get('/posters/{poster}', [PosterController::class, 'show'])->name('posters.show');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::get('/donate', [PageController::class, 'donate'])->name('donate');
    Route::get('/faq', [PageController::class, 'faq'])->name('faq');

    Route::get('/location', [PageController::class, 'location'])->name('location');

    // 💡 REMOVED: Role selection route deleted as requested.

    // Auth scaffolding (Breeze)
    require __DIR__.'/auth.php';

    // Authenticated user routes (normal users)
    Route::middleware(['auth', 'verified'])->group(function () {
        // Profile routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('/dashboard', function () {
            return Auth::user()->isAdmin() ? redirect()->route('admin.dashboard') : view('dashboard');
        })->name('dashboard');

        // User dashboard and profile - redirect to profile
        Route::get('/user/dashboard', function () {
            return redirect()->route('profile.edit');
        })->name('user.dashboard');

        // Pet registration (pre-register)
        Route::post('/pets', [PetController::class, 'store'])->name('pets.store');

        // Lost & Found: Create poster
        Route::get('/lost-found/create', [PosterController::class, 'create'])->name('posters.create');
        Route::post('/lost-found', [PosterController::class, 'store'])->name('posters.store');

        // User posters management
        Route::get('/my-posters', function () {
            $posters = Auth::user()->posters()->paginate(10);
            return view('user.posters', compact('posters'));
        })->name('user.posters');

        Route::get('/posters/{poster}/edit', [PosterController::class, 'edit'])->name('posters.edit');
        Route::patch('/posters/{poster}', [PosterController::class, 'update'])->name('posters.update');
        Route::patch('/posters/{poster}/reunite', [PosterController::class, 'reunite'])->name('posters.reunite');
        Route::delete('/posters/{poster}', [PosterController::class, 'destroy'])->name('posters.destroy');


        // Pet requests: Submit claim/adopt (PROTECTED ROUTE)
        Route::post('/pets/{pet}/request', [PetController::class, 'request'])->name('pets.request');

        // My requests view
        Route::get('/my-requests', function () {
            $query = Auth::user()->requests()->with('requestable');

            // Apply filters
            if (request('status')) {
                $query->where('status', request('status'));
            }
            if (request('type')) {
                $query->where('type', request('type'));
            }

            $requests = $query->paginate(12)->appends(request()->query());
            return view('user.requests', compact('requests'));
        })->name('user.requests');

        // Allow user to cancel their own request
        Route::delete('/my-requests/{request}', function (\App\Models\PetRequest $request) {
            if ($request->user_id !== Auth::id()) abort(403);
            $request->delete();
            return redirect()->route('user.requests')->with('success', 'Request cancelled.');
        })->name('user.requests.destroy');

        // Claimed or Adopted Pets view (index)
        Route::get('/my-adopted-claimed-pets', function () {
            // Show pets that are marked 'adopted' or 'claimed' by admin
            // and that have a completed request submitted by the current user.
            $tab = request('tab'); // optional: 'adopted' or 'claimed'
            $query = \App\Models\Pet::query();

            if (in_array($tab, ['adopted', 'claimed'])) {
                $query->where('status', $tab);
            } else {
                $query->whereIn('status', ['adopted', 'claimed']);
            }

            $query->whereHas('requests', function ($q) {
                    $q->where('user_id', Auth::id())
                      ->where('status', 'completed')
                      ->whereIn('type', ['adopt', 'claim']);
                })
                ->with(['requests' => function ($q) {
                    // only load the completed requests for the current user
                    $q->where('status', 'completed')->where('user_id', Auth::id());
                }, 'requests.user']);

            $pets = $query->paginate(10)->appends(request()->query());

            return view('user.claimed-adopted.index', compact('pets', 'tab'));
        })->name('user.adopted-claimed-pets');

        // Claimed or Adopted Pets - show individual pet details (user completed request check)
        Route::get('/my-adopted-claimed-pets/{pet}', function (\App\Models\Pet $pet) {
            $hasCompleted = $pet->requests()->where('user_id', Auth::id())->where('status', 'completed')->exists();
            if (!$hasCompleted) abort(403);
            $pet->load(['requests' => function ($q) { $q->where('status', 'completed')->where('user_id', Auth::id()); }, 'requests.user']);

            // Get latest claim and adopt requests for timeline
            $latestClaim = $pet->requests->where('type', 'claim')->sortByDesc('updated_at')->first();
            $latestAdopt = $pet->requests->where('type', 'adopt')->sortByDesc('updated_at')->first();
            $owner = Auth::user();

            // Get the request for displaying photos and additional data
            $request = $pet->requests->first();

            return view('user.claimed-adopted.show', compact('pet', 'latestClaim', 'latestAdopt', 'owner', 'request'));
        })->name('user.adopted-claimed-pets.show');

        // Claimed or Adopted Pets - delete (remove from user's list)
        Route::delete('/my-adopted-claimed-pets/{pet}', function (\App\Models\Pet $pet) {
            $hasCompleted = $pet->requests()->where('user_id', Auth::id())->where('status', 'completed')->exists();
            if (!$hasCompleted) abort(403);

            // Delete the completed request for this pet
            $pet->requests()
                ->where('user_id', Auth::id())
                ->where('status', 'completed')
                ->delete();

            return redirect()->route('user.adopted-claimed-pets')->with('success', 'Record deleted successfully.');
        })->name('user.adopted-claimed-pets.destroy');

        // Show individual request details
        Route::get('/my-requests/{request}', function (\App\Models\PetRequest $request) {
            if ($request->user_id !== Auth::id()) abort(403);
            return view('user.requests.show', compact('request'));
        })->name('user.requests.show');

        // Pet registration routes (User only)
        Route::resource('pet-registrations', PetRegistrationController::class);
        Route::post('/pet-registrations/{pet}/approve', [PetRegistrationController::class, 'approve'])->name('pet-registrations.approve');
        Route::post('/pet-registrations/{pet}/deny', [PetRegistrationController::class, 'deny'])->name('pet-registrations.deny');
    });

    // Admin routes (auth + admin middleware)
    Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Pets CRUD
        Route::resource('pets', AdminPetController::class);
        Route::post('/pets/{pet}/urgent', [AdminPetController::class, 'setUrgent'])->name('pets.set-urgent');
        Route::post('/pets/{pet}/mark-adopted', [AdminPetController::class, 'markAsAdopted'])->name('pets.mark-adopted');
        Route::get('/pets/{pet}/mark-claimed', function() {
            return back()->with('info', 'Please use the form to mark this pet as claimed.');
        });
        Route::post('/pets/{pet}/mark-claimed', [AdminPetController::class, 'markAsClaimed'])->name('pets.mark-claimed');

        // Adoption & Claim History
        Route::get('/adoption-claim-history', [AdminPetController::class, 'adoptionClaimHistory'])->name('adoption-claim-history');

        // Pet Registrations CRUD (Admin only) - Independent from user pet-registrations
        Route::resource('pet-registrations', \App\Http\Controllers\Admin\PetRegistrationController::class);
        Route::post('/pet-registrations/{pet_registration}/approve', [\App\Http\Controllers\Admin\PetRegistrationController::class, 'approve'])->name('pet-registrations.approve');
        Route::post('/pet-registrations/{pet_registration}/deny', [\App\Http\Controllers\Admin\PetRegistrationController::class, 'deny'])->name('pet-registrations.deny');

        // Announcements CRUD
        Route::resource('announcements', AdminAnnouncementController::class);

        // Posters management
        Route::get('/posters', function () {
            $query = \App\Models\Poster::with('user');

            // Apply filters
            if (request('status')) {
                $query->where('status', request('status'));
            }
            if (request('type')) {
                $query->where('type', request('type'));
            }

            $posters = $query->paginate(10);
            return view('admin.posters.index', compact('posters'));
        })->name('posters.index');

        Route::delete('/posters/{poster}', [PosterController::class, 'destroy'])->name('posters.destroy');

        // Requests management
        Route::resource('requests', PetRequestController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::post('/requests/{petRequest}/approve', [PetRequestController::class, 'approve'])->name('requests.approve');
        Route::post('/requests/{petRequest}/deny', [PetRequestController::class, 'deny'])->name('requests.deny');
        Route::post('/requests/{petRequest}/finalize', [PetRequestController::class, 'finalize'])->name('requests.finalize');

        // Reports
        Route::get('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
        Route::post('/reports/export', [ReportController::class, 'export'])->name('reports.export');

        // Users management
        Route::resource('users', UserController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    });
});


Route::get('/check-admin', function () {
    return "<h2>✅ Welcome, Admin!</h2>";
})->middleware(['auth', 'admin']);
Route::get('/check-user', function () {
    return "<h2>✅ Welcome, User!</h2>";
})->middleware('auth');
