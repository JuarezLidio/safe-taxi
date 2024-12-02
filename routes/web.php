<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmergencyContactController;
use App\Http\Controllers\Inertia\CustomUserProfileController;
use App\Http\Controllers\TransportController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
})->name('home');

Route::group(['middleware' => ['auth:sanctum', config('jetstream.auth_session'), 'permission.role', 'verified'],'prefix' => '/dashboard'], function () {
//Route::group(['middleware' => ['validaterolespermissions', 'auth'], 'prefix' => '/dashboard'], function () {
//Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified', ])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/roles/relationship', [RoleController::class, 'indexRelationship'])->name('roles.indexRelationship');
    Route::get('/roles/relationship/{role}/edit', [RoleController::class, 'editRelationship'])->name('roles.editRelationship');
    Route::put('/roles/relationship/{role}', [RoleController::class, 'updateRelationship'])->name('roles.updateRelationship');

    Route::resourceSoftDelete('roles', RoleController::class);
    Route::resource('roles',  RoleController::class);

    Route::resourceSoftDelete('permissions', PermissionController::class);
    Route::resource('permissions',  PermissionController::class);

    Route::resourceSoftDelete('menus', MenuController::class);
    Route::resource('menus',  MenuController::class);

    Route::resourceSoftDelete('users', UserController::class);
    Route::resource('users',  UserController::class);

    Route::get('/user/profile', [CustomUserProfileController::class, 'show'])->name('profile.show');
    Route::resourceSoftDelete('emergency_contacts', EmergencyContactController::class);
    Route::resource('emergency_contacts',  EmergencyContactController::class);

    Route::resourceSoftDelete('drivers', DriverController::class);
    Route::post('/drivers/{driver}', [DriverController::class, 'update'])->name('drivers.update');
    Route::resource('drivers',  DriverController::class)->except('update');

    Route::resourceSoftDelete('transports', TransportController::class);
    Route::resource('transports',  TransportController::class);

    Route::resourceSoftDelete('assignments', AssignmentController::class);
    Route::resource('assignments',  AssignmentController::class);
});

