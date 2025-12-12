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
    DegreesController,
    StatusController,
    QualificationController,
    LicenseController
};

// ==================== FRONTEND ROUTES ====================
Route::get('/', function () {
    return view('frontend.home');
})->name('frontend.home');

Route::get('/about', function () {
    return view('frontend.about');
})->name('frontend.about');

Route::get('/verify', function () {
    return view('frontend.verify');
})->name('frontend.verify');

// Admin Panel link
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
            'practitionerCount' => \App\Models\Practitioner::count(),
            'specialityCount' => \App\Models\Speciality::count(),
            'institutionCount' => \App\Models\Institution::count(),
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
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('/roles', function () {
    return redirect()->route('admin.roles.index');
});

// ==================== KMPDC IMPORT ROUTES ====================
Route::prefix('kmpdc')->name('kmpdc.')->group(function () {
    Route::get('/import', [\App\Http\Controllers\KmpdcImportController::class, 'index'])->name('import.index');
    Route::post('/sync', [\App\Http\Controllers\KmpdcImportController::class, 'sync'])->name('sync');
    Route::post('/extract', [\App\Http\Controllers\KmpdcImportController::class, 'extract'])->name('extract');
    Route::post('/import', [\App\Http\Controllers\KmpdcImportController::class, 'import'])->name('import');
    Route::post('/run-all', [\App\Http\Controllers\KmpdcImportController::class, 'runAll'])->name('runAll');
});

// ==================== RESOURCE ROUTES ====================
Route::resource('statuses', StatusController::class);
Route::resource('specialities', SpecialityController::class);
Route::resource('subspecialities', SubSpecialityController::class);
Route::resource('institutions', InstitutionController::class);
Route::resource('degrees', DegreeController::class);
Route::resource('practitioners', PractitionerController::class);
Route::resource('contacts', ContactController::class);
Route::resource('qualifications', QualificationController::class);
Route::resource('licenses', LicenseController::class);
Route::resource('users', UserController::class);

// User Management Routes
Route::resource('users', UserController::class);
Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
Route::get('/users/{user}/activity', [UserController::class, 'activity'])->name('users.activity');

// ==================== FALLBACK ROUTE ====================
Route::fallback(function () {
    return redirect()->route('frontend.home');
});