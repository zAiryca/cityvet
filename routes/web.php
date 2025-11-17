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
    Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
    Route::get('/pets/{pet}', [PetController::class, 'show'])->name('pets.show');
    Route::post('/pets/{pet}/request', [PetController::class, 'request'])->name('pets.request');

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

    // Role selection (keep for backward compatibility, but redirect to login)
    Route::get('/role-selection', function () {
        return redirect()->route('login');
    })->name('role-selection');

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

        // Profile routes are defined above

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



        // Pet requests: Submit claim/adopt
        Route::post('/pets/{pet}/request', [PetController::class, 'request'])->name('pets.request');

        // My requests view
        Route::get('/my-requests', function () {
            $requests = Auth::user()->requests()->with('requestable')->paginate(10);
            return view('user.requests', compact('requests'));
        })->name('user.requests');

        // Pet registration routes
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
        Route::post('/pets/{pet}/mark-claimed', [AdminPetController::class, 'markAsClaimed'])->name('pets.mark-claimed');

        // Pet Registrations CRUD
        Route::resource('pet-registrations', \App\Http\Controllers\Admin\PetRegistrationController::class);
        Route::post('/pet-registrations/{pet}/approve', [\App\Http\Controllers\Admin\PetRegistrationController::class, 'approve'])->name('pet-registrations.approve');
        Route::post('/pet-registrations/{pet}/deny', [\App\Http\Controllers\Admin\PetRegistrationController::class, 'deny'])->name('pet-registrations.deny');

        // Announcements CRUD
        Route::resource('announcements', AdminAnnouncementController::class);
    });

    // Admin routes (auth + admin middleware)
    Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Pets CRUD
        Route::resource('pets', AdminPetController::class);
        Route::post('/pets/{pet}/urgent', [AdminPetController::class, 'setUrgent'])->name('pets.set-urgent');
        Route::post('/pets/{pet}/mark-adopted', [AdminPetController::class, 'markAsAdopted'])->name('pets.mark-adopted');
        Route::post('/pets/{pet}/mark-claimed', [AdminPetController::class, 'markAsClaimed'])->name('pets.mark-claimed');

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

        // Reports
        Route::get('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');

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
