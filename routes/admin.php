<?php

use App\Http\Controllers\Admin\AccessController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Developer\TablesController;
use Illuminate\Support\Facades\Route;


// developer routes
Route::resource('tables', TablesController::class)->except(['show']);


// admin routes
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('roles', RoleController::class)->except(['create', 'show']);
Route::resource('permission', PermissionController::class)->except(['create', 'show']);
Route::resource('users', UserController::class)->except(['show']);
Route::post('users/ban', [UserController::class, 'banned'])->name('users.ban');
Route::get('users/profile', [UserController::class, 'profile'])->name('users.profile');
Route::put('users/profile/update', [UserController::class, 'profile_update'])->name('users.profile.update');
Route::resource('access', AccessController::class)->only('index', 'update');
Route::post('access/get_by_role', [AccessController::class, 'perms_by_role'])->name('access.get_by_role');

Route::put('site_settings/save', [SiteSettingsController::class, 'save'])->name('site_settings.save');
Route::resource("site_settings", SiteSettingsController::class)->except('show');

Route::get('logout', [AuthController::class, 'destroy'])->name('logout'); 
