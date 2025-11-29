<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');

// Admin Dashboard Routes (require authentication)
Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {
    route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Pengaturan Web
    Route::get('/pengaturan-web', [DashboardController::class, 'pengaturanWeb'])->name('pengaturan-web');
    Route::put('/pengaturan-web', [DashboardController::class, 'updatePengaturanWeb'])->name('pengaturan-web.update');
    
    // Contact Persons
    Route::get('/contact-persons', [DashboardController::class, 'contactPersons'])->name('contact-persons');
    Route::get('/contact-persons/create', [DashboardController::class, 'createContactPerson'])->name('contact-persons.create');
    Route::post('/contact-persons', [DashboardController::class, 'storeContactPerson'])->name('contact-persons.store');
    Route::get('/contact-persons/{contactPerson}/edit', [DashboardController::class, 'editContactPerson'])->name('contact-persons.edit');
    Route::put('/contact-persons/{contactPerson}', [DashboardController::class, 'updateContactPerson'])->name('contact-persons.update');
    Route::delete('/contact-persons/{contactPerson}', [DashboardController::class, 'destroyContactPerson'])->name('contact-persons.destroy');
    Route::patch('/contact-persons/{contactPerson}/toggle', [DashboardController::class, 'toggleContactPerson'])->name('contact-persons.toggle');
    
    // Testimoni
    Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni');
    Route::get('/testimoni/create', [TestimoniController::class, 'create'])->name('testimoni.create');
    Route::post('/testimoni', [TestimoniController::class, 'store'])->name('testimoni.store');
    Route::get('/testimoni/{testimoni}/edit', [TestimoniController::class, 'edit'])->name('testimoni.edit');
    Route::put('/testimoni/{testimoni}', [TestimoniController::class, 'update'])->name('testimoni.update');
    Route::delete('/testimoni/{testimoni}', [TestimoniController::class, 'destroy'])->name('testimoni.destroy');
    Route::patch('/testimoni/{testimoni}/toggle', [TestimoniController::class, 'toggle'])->name('testimoni.toggle');
    
    // Pricing
    Route::get('/pricing', [DashboardController::class, 'pricing'])->name('pricing');
    Route::get('/pricing/create', [DashboardController::class, 'createPricing'])->name('pricing.create');
    Route::post('/pricing', [DashboardController::class, 'storePricing'])->name('pricing.store');
    Route::get('/pricing/{package}/edit', [DashboardController::class, 'editPricing'])->name('pricing.edit');
    Route::put('/pricing/{package}', [DashboardController::class, 'updatePricing'])->name('pricing.update');
    Route::delete('/pricing/{package}', [DashboardController::class, 'destroyPricing'])->name('pricing.destroy');
    Route::patch('/pricing/{package}/toggle', [DashboardController::class, 'togglePricing'])->name('pricing.toggle');
    Route::patch('/pricing/{package}/popular', [DashboardController::class, 'togglePopular'])->name('pricing.popular');
});

// Change default dashboard to redirect to admin dashboard
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
