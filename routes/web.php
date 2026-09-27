<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserManagementController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {

        $user = auth()->user();

        return match ($user->role->slug) {

            'super_admin' =>
                redirect()->route('super-admin.dashboard'),

            'admin' =>
                redirect()->route('admin.dashboard'),

            'user' =>
                redirect()->route('user.dashboard'),

            'sub_user' =>
                redirect()->route('sub-user.dashboard'),

            default => abort(403),
        };
    })->name('dashboard');


    Route::middleware('role:super_admin')
        ->prefix('super-admin')
        ->name('super-admin.')
        ->group(function () {

            Route::get('/dashboard', [
                DashboardController::class,
                'superAdmin'
            ])->name('dashboard');

            Route::resource(
                'users',
                UserManagementController::class
            );
        });


    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/dashboard', [
                DashboardController::class,
                'admin'
            ])->name('dashboard');

            Route::resource(
                'users',
                UserManagementController::class
            );
        });


    Route::middleware('role:user')
        ->prefix('user')
        ->name('user.')
        ->group(function () {

            Route::get('/dashboard', [
                DashboardController::class,
                'user'
            ])->name('dashboard');

            Route::resource(
                'sub-users',
                UserManagementController::class
            );
        });


    Route::middleware(['auth', 'role:sub_user'])
        ->prefix('sub-user')
        ->name('sub-user.')
        ->group(function () {

            Route::get('/dashboard', [
                DashboardController::class,
                'subUser'
            ])->name('dashboard');

        });
});

Route::middleware(['auth'])->group(function () {

    Route::get('/users/create', [
        UserManagementController::class,
        'create'
    ])->name('users.create');

    Route::post('/users', [
        UserManagementController::class,
        'store'
    ])->name('users.store');

});

require __DIR__.'/auth.php';