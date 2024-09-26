<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionController;

use App\Http\Controllers\CitiesController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ProvincesController;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [RegionController::class, 'index'])->name('dashboard');
    Route::get('/cities', [CitiesController::class, 'index'])->name('cities');
    Route::get('/employees', [EmployeesController::class, 'index'])->name('employees');
    Route::get('/provinces', [ProvincesController::class, 'index'])->name('provinces');

    // Display ditailes routes
    Route::get('/regions/{regionId}/cities', [CitiesController::class, 'showByRegion'])->name('regions.cities');
    Route::get('cities/{cityId}/provinces', [ProvincesController::class, 'showByCity'])->name('cities.provinces');
    Route::get('provinces/{provinceId}/employees', [EmployeesController::class, 'showByProvince'])->name('provinces.employees');


    // DElete Routes
    Route::delete('/regions/{region}', [RegionController::class, 'destroy'])->name('regions.destroy');
    Route::delete('/cities/{city}', [CitiesController::class, 'destroy'])->name('cities.destroy');
    Route::delete('/provinces/{province}', [ProvincesController::class, 'destroy'])->name('provinces.destroy');
    Route::delete('/employees/{employee}', [EmployeesController::class, 'destroy'])->name('employees.destroy');

    // Update Routes


});

// Route::get('/dashboard', [RegionController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard'); // This route should be fine

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
