<?php

use App\Http\Controllers\SocialController;
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

Route::get('/', function () {
    return view('tasks');
})->name('tasks');

Route::get('/teams', function () {
    return view('teams');
})->name('teams');

Route::get('/my-teams', function () {
    return view('my-teams');
})->name('my-teams');

Route::prefix('auth')->group(function () {
    Route::get('/{provider}/redirect', [SocialController::class, 'redirectToProvider'])->name('social.login');
    Route::get('/{provider}/callback', [SocialController::class, 'handleProviderCallback']);
});

Route::get('/logout', [SocialController::class, 'logout'])->name('logout');
