<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\EmployeeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/api', function () {
    return Storage::disk('local')->get( '/openapi.json');
});
Route::prefix('api')->group(function () {
    Route::resource('/employees', App\Http\Controllers\Api\EmployeeController::class)->only([
        'index', 'store', 'update', 'destroy'
    ])->names([
        'index' => 'api/employees.index',
        'store' => 'api/employees.index',
        'update' => 'api/employees.update',
        'destroy' => 'api/employees.destroy',
    ]);
    Route::resource('/branches', App\Http\Controllers\Api\BranchController::class)->only([
        'index', 'store', 'update', 'destroy'
    ]);
});

Route::resource('branches', BranchController::class);
Route::resource('employees', EmployeeController::class);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
