<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BackendController;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/projects/{uuid}', [FrontendController::class, 'project'])->name('project');
Route::post('/contact', [FrontendController::class, 'store'])->name('contact.store');


Route::middleware('auth')->group(function () {
    
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/private-messages', [BackendController::class, 'privateMessages'])->name('private-messages');
    Route::get('/private-messages/{uuid}', [BackendController::class, 'showPrivateMessage'])->name('private-messages.show');
    Route::post('/private-messages/{uuid}/reply', [BackendController::class, 'replyToMessage'])->name('private-messages.reply');
    Route::get('/new-messages', [BackendController::class, 'newMessages'])->name('new-messages');
    Route::get('/userinfo', [BackendController::class, 'showUser'])->name('user.show');
    
});

require __DIR__.'/settings.php';
