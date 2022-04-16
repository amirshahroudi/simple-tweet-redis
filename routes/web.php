<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/mock', [HomeController::class, 'mock']);

Route::resource('tweet', \App\Http\Controllers\TweetController::class)->only(['index', 'create', 'store', 'show']);
Route::post('tweet/{id}/comment', [\App\Http\Controllers\TweetController::class, 'store_comment'])->name('comment.store');
Route::post('tweet/{id}/like', [\App\Http\Controllers\TweetController::class, 'like_tweet'])->name('tweet.like');
Route::post('tweet/{id}/dislike', [\App\Http\Controllers\TweetController::class, 'dislike_tweet'])->name('tweet.dislike');
Route::post('comment/{id}/like', [\App\Http\Controllers\TweetController::class, 'like_comment'])->name('comment.like');
Route::post('comment/{id}/dislike', [\App\Http\Controllers\TweetController::class, 'dislike_comment'])->name('comment.dislike');
