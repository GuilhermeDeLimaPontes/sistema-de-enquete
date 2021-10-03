<?php

use App\Http\Controllers\PollController;
use App\Http\Controllers\UserController;
use App\Models\Poll;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'login')->name('login');
Route::post('users/authenticate', [UserController::class, 'authenticate'])->name('users.do.authenticate');

Route::get('poll/{poll}/{slug}/vote',[PollController::class,'showPollToVote'])->name('show.poll.to.vote');
Route::post('poll/sumvote', [PollController::class, 'sumVote'])->name('poll.sum.vote');

Route::group(['middleware' => 'auth'], function () {
    Route::get('users/', [UserController::class, 'index'])->name('users.index');
    Route::get('users/logout', [UserController::class, 'logout'])->name('users.logout');

    Route::resource('poll', \App\Http\Controllers\PollController::class)->except(['index'])->middleware('auth');
    Route::get('poll/{poll}/{slug}', [\App\Http\Controllers\PollController::class, 'show'])->name('poll.show');
    Route::get('poll/{poll}/edit/{slug}', [\App\Http\Controllers\PollController::class, 'edit'])->name('poll.edit');
});
