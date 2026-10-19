<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/services/{slug}', [PageController::class, 'service'])->name('services.show');
Route::get('/portfolio', [PageController::class, 'portfolio'])->name('portfolio');
Route::redirect('/clients', '/portfolio', 301);
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactStore'])->name('contact.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'create'])->name('login');
        Route::post('/login', [AuthController::class, 'store'])->name('login.store');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
        Route::get('/inquiries', [DashboardController::class, 'inquiries'])->name('inquiries');
        Route::get('/inquiries/{inquiry}', [DashboardController::class, 'showInquiry'])->name('inquiries.show');
        Route::get('/team', [TeamController::class, 'index'])->name('team.index');
        Route::get('/team/create', [TeamController::class, 'create'])->name('team.create');
        Route::post('/team', [TeamController::class, 'store'])->name('team.store');
        Route::get('/team/{team}/edit', [TeamController::class, 'edit'])->name('team.edit');
        Route::put('/team/{team}', [TeamController::class, 'update'])->name('team.update');
        Route::delete('/team/{team}', [TeamController::class, 'destroy'])->name('team.destroy');

        Route::get('/portfolio', [ProjectController::class, 'index'])->name('portfolio');
        Route::get('/portfolio/create', [ProjectController::class, 'create'])->name('portfolio.create');
        Route::post('/portfolio', [ProjectController::class, 'store'])->name('portfolio.store');
        Route::get('/portfolio/{project}/edit', [ProjectController::class, 'edit'])->name('portfolio.edit');
        Route::put('/portfolio/{project}', [ProjectController::class, 'update'])->name('portfolio.update');
        Route::delete('/portfolio/{project}', [ProjectController::class, 'destroy'])->name('portfolio.destroy');
    });
});
