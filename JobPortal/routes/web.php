<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

// all listings
Route::get('/', [ListingController::class,'index']);

// create listing
Route::get('/listing/create', [ListingController::class, 'create'])->middleware('auth');

// store listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// edit form listing
Route::get('/listing/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

// update listing
Route::put('/listing/{listing}', [ListingController::class, 'update'])->middleware('auth');

// delete listing
Route::delete('/listing/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// manage listing
Route::get('/listing/manage', [ListingController::class, 'manage'])->middleware('auth');

// single listing
Route::get('/listing/{listing}', [ListingController::class, 'show'])->middleware('auth');

// show register/create form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

// create user
Route::post('/users', [UserController::class, 'store']);

// logout user
Route::post('/logout', [UserController::class, 'logout']);

// login user
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// authenticate user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
