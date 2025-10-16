<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PosterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PetRequestController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PetController as AdminPetController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\ReportController;

Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
Route::post('/pets/{pet}/request', [PetController::class, 'request'])->name('pets.request');

// Public routes (no auth needed)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/impounded', [PetController::class, 'impounded'])->name('pets.impounded');
Route::get('/adoptable', [PetController::class, 'adoptable'])->name('pets.adoptable');
Route::get('/lost-found', [PosterController::class, 'index'])->name('posters.index');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/posters/{poster}', [PosterController::class, 'show'])->name('posters.show');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/donate', [PageController::class, 'donate'])->name('donate');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/location', [PageController::class, 'location'])->name('location');

// Auth scaffolding (Breeze)
require __DIR__.'/auth.php';

// Authenticated user routes (normal users)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Auth::user()->isAdmin() ? redirect()->route('admin.dashboard') : redirect()->route('user.dashboard');
    })->name('dashboard');

    // User dashboard and profile
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/profile', function () {
        $user = Auth::user();
        $pets = $user->pets()->where('status', 'registered')->get();
        return view('user.profile', compact('user', 'pets'));
    })->name('profile');

    // Pet registration (pre-register)
    Route::post('/pets', [PetController::class, 'store'])->name('pets.store');

    // Lost & Found: Create poster
    Route::get('/lost-found/create', [PosterController::class, 'create'])->name('posters.create');
    Route::post('/lost-found', [PosterController::class, 'store'])->name('posters.store');

    // Events: Register pet
    Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');

    // Pet requests: Submit claim/adopt
    Route::post('/pets/{pet}/request', [PetController::class, 'request'])->name('pets.request');

    // My requests view
    Route::get('/my-requests', function () {
        $requests = Auth::user()->requests()->with('pet')->paginate(10);
        return view('user.requests', compact('requests'));
    })->name('user.requests');
});

// Admin routes (auth + admin middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pets CRUD
    Route::resource('pets', AdminPetController::class);
    Route::post('/pets/{pet}/urgent', [AdminPetController::class, 'setUrgent'])->name('pets.set-urgent');

    // Events CRUD
    Route::resource('events', AdminEventController::class);

    // Posters management
    Route::get('/posters', function () {
        $posters = \App\Models\Poster::with('user')->paginate(10);
        return view('admin.posters.index', compact('posters'));
    })->name('posters.index');

    Route::patch('/posters/{poster}/approve', function ($poster) {
        $poster->update(['approved' => true]);
        return back()->with('success', 'Poster approved.');
    })->name('posters.approve');

    Route::delete('/posters/{poster}', [PosterController::class, 'destroy'])->name('posters.destroy');

    // Requests management
    Route::resource('requests', PetRequestController::class)->only(['index', 'show', 'update', 'destroy']);

    // Reports
    Route::get('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
});


Route::get('/check-admin', function () {
    return "<h2>✅ Welcome, Admin!</h2>";
})->middleware(['auth', 'admin']);
Route::get('/check-user', function () {
    return "<h2>✅ Welcome, User!</h2>";
})->middleware('auth');

