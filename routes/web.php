<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MaternalController;
use App\Http\Controllers\Admin\ChildNutritionController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;
use App\Http\Controllers\PatientController;

Route::get('/', function () {
    return view('welcome');
});



////// Only for user Route
Route::middleware(['auth', IsUser::class])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
////// End Only for user Route



///// Only for Admin Route
Route::middleware(['auth', IsAdmin::class])->group(function () {

Route::get('/admin/dashboard', [AdminController::class,
'AdminDashboard'])->name('admin.dashboard');

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

Route::resource('patients', PatientController::class);

});
////// End Only for Admin Route




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
