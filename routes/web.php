<?php

use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Volt::route('/', 'tasks-page')->name("tasks");
    Volt::route('/teams', 'teams-page')->name("teams");
    Volt::route('/my-teams', 'my-teams-page')->name("my-teams");

    Route::get('/{provider}/logout', [SocialController::class, 'logout'])->name('logout');
});

Route::prefix('auth')->group(function () {
    Route::get('/{provider}/redirect', [SocialController::class, 'redirectToProvider'])->name('login');
    Route::get('/{provider}/callback', [SocialController::class, 'handleProviderCallback']);
});

