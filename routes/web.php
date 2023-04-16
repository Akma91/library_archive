<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SessionsController;

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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('login', [SessionsController::class, 'create'])->name('login')->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->name('logout')->middleware('auth');


Route::get('catalog', [BookController::class, 'index'])->name('catalog');
Route::get('books/{book:slug}', [BookController::class, 'details'])->name('bookDetails');

Route::post('reservation', [ReservationController::class, 'store'])->name('reservation')->middleware('auth');;

//Route::get('posts/{post:slug}', [PostController::class, 'show']);
//Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);
