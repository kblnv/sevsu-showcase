<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/auth/redirect', function () {
    return Socialite::driver('moodle')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('moodle')->user();
});
