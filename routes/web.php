<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MaternalController;
use App\Http\Controllers\Admin\ChildNutritionController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\ActivityLogsController;
use App\Http\Controllers\PatientController;

Route::get('/', function () {
    return view('welcome');
});



////// Dashboard Route (for all authenticated users)
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
////// End Dashboard Route



///// Only for Admin Route
Route::middleware(['auth', 'admin'])->group(function () {

Route::get('/admin/dashboard', [AdminController::class,
'AdminDashboard'])->name('admin.dashboard');

// User Management Routes
Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');
Route::get('/admin/users/{user}/edit', [UserManagementController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [UserManagementController::class, 'update'])->name('admin.users.update');
Route::post('/admin/users/{user}/approve', [UserManagementController::class, 'approve'])->name('admin.users.approve');
Route::post('/admin/users/{user}/deny', [UserManagementController::class, 'deny'])->name('admin.users.deny');
Route::put('/admin/users/{user}/role', [UserManagementController::class, 'updateRole'])->name('admin.users.updateRole');
Route::delete('/admin/users/{user}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');

// Activity Logs Routes
Route::get('/admin/logs', [ActivityLogsController::class, 'index'])->name('admin.logs.index');

});
////// End Only for Admin Route



///// Only for Staff (Health Workers) Route
Route::middleware(['auth', 'staff'])->group(function () {

// Maternal Care Routes
Route::get('/maternal-care', [MaternalController::class, 'index'])->name('maternal.index');
Route::post('/maternal-care/store', [MaternalController::class, 'store'])->name('maternal.store');
Route::get('/maternal-care/{maternalRecord}', [MaternalController::class, 'show'])->name('maternal.show');
Route::get('/maternal-care/{maternalRecord}/edit', [MaternalController::class, 'edit'])->name('maternal.edit');
Route::patch('/maternal-care/{maternalRecord}', [MaternalController::class, 'update'])->name('maternal.update');
Route::delete('/maternal-care/{maternalRecord}', [MaternalController::class, 'destroy'])->name('maternal.destroy');
Route::patch('/maternal-care/{id}/restore', [MaternalController::class, 'restore'])->name('maternal.restore');
Route::get('/maternal-care/{maternalRecord}/pdf', [MaternalController::class, 'generatePDF'])->name('maternal.pdf');

// Child Nutrition Routes
Route::get('/child-nutrition', [ChildNutritionController::class, 'index'])->name('child-nutrition.index');
Route::post('/child-nutrition/store', [ChildNutritionController::class, 'store'])->name('child-nutrition.store');
Route::get('/child-nutrition/{id}/report', [ChildNutritionController::class, 'generateChildHealthReport'])->name('child-nutrition.report');

// Patient Routes
Route::get('/patients/select', [PatientController::class, 'select'])->name('patients.select');
Route::resource('patients', PatientController::class);

});
////// End Only for Staff Route




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
