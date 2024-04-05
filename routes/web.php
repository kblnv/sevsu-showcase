<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\SocialController;
use App\Livewire\MyTeamsPage;
use App\Livewire\TasksPage;
use App\Livewire\TeamsPage;
use Illuminate\Support\Facades\Route;

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
    // Route::get('/', [MainController::class, 'index'])->name('tasks');

    // Route::get('/teams', function () {
    //     return view('teams');
    // })->name('teams');

    // Route::get('/my-teams', function () {
    //     return view('my-teams');
    // })->name('my-teams');

    Route::get('/', TasksPage::class)->name("tasks");
    Route::get('/teams', TeamsPage::class)->name("teams");
    Route::get('/my-teams', MyTeamsPage::class)->name("my-teams");

    Route::get('/{provider}/logout', [SocialController::class, 'logout'])->name('logout');
});

Route::prefix('auth')->group(function () {
    Route::get('/{provider}/redirect', [SocialController::class, 'redirectToProvider'])->name('login');
    Route::get('/{provider}/callback', [SocialController::class, 'handleProviderCallback']);
});
