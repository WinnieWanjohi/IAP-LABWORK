<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\{
    PractitionerController,
    ContactController,
    UserController,
    SpecialityController,
    SubSpecialityController,
    InstitutionsController,
    DegreesController
};

// ==================== FRONTEND ROUTES ====================
Route::get('/', function () {
    return view('frontend.home');
})->name('frontend.home');  // Main home page

Route::get('/about', function () {
    return view('frontend.about');
})->name('frontend.about');

Route::get('/verify', function () {
    return view('frontend.verify');
})->name('frontend.verify');

// Admin Panel link - redirects to admin dashboard
Route::get('/mkubwa', function () {
    return redirect()->route('admin.dashboard');
})->name('admin.panel');

// ==================== ADMIN/BACKEND ROUTES ====================
Route::prefix('admin')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'pageTitle' => 'Dashboard',
            'userCount' => \App\Models\User::count(),
            'roleCount' => \App\Models\Role::count(),
        ]);
    })->name('admin.dashboard');
    
    // Admin Roles CRUD Routes
    Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::get('/roles/{role}', [RoleController::class, 'show'])->name('admin.roles.show');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
});

// ==================== LEGACY/COMPATIBILITY ROUTES ====================
// Redirect old /dashboard to admin dashboard
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});

// Redirect /roles to admin/roles for backward compatibility
Route::get('/roles', function () {
    return redirect()->route('admin.roles.index');
});

// KMPDC Import Routes
Route::prefix('kmpdc')->name('kmpdc.')->group(function () {
    Route::get('/import', [\App\Http\Controllers\KmpdcImportController::class, 'index'])->name('import.index');
    Route::post('/sync', [\App\Http\Controllers\KmpdcImportController::class, 'sync'])->name('sync');
    Route::post('/extract', [\App\Http\Controllers\KmpdcImportController::class, 'extract'])->name('extract');
    Route::post('/import', [\App\Http\Controllers\KmpdcImportController::class, 'import'])->name('import');
    Route::post('/run-all', [\App\Http\Controllers\KmpdcImportController::class, 'runAll'])->name('runAll');
});

// Resource Routes (NO AUTHENTICATION REQUIRED)
Route::resource('practitioners', PractitionerController::class);
Route::resource('contacts', ContactController::class);
Route::resource('users', UserController::class);
Route::resource('statuses', statusesController::class);
Route::resource('specialities', SpecialityController::class);
Route::resource('subspecialities', SubSpecialityController::class);
Route::resource('institutions', InstitutionsController::class);
Route::resource('degrees', DegreesController::class);

// Fallback route
Route::fallback(function () {
    return redirect()->route('home');
});