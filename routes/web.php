<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\ImagesController;

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
    return Redirect::route("albums.index");
});

//Admin Middleware   Route::middleware(CheckAdminRole::class)->group(function () {

    Route::group([], function () {
        //? Controller with resource routes
        Route::resource('/albums', AlbumsController::class);
        Route::resource('/images', ImagesController::class)->except('index','store');
        Route::resource('/users', UsersController::class);
        Route::get('/gallery/{id}', [ImagesController::class, 'index'])->name('album.index');
        Route::POST('/gallery/store', [ImagesController::class, 'store'])->name('albums.store');

        Route::GET('/login', [UsersController::class, 'loginindex'])->name('login.index');

        //? autocompletesearch 
        Route::GET('/album/search', [AlbumsController::class , "autocompletesearch"]);

    });


   /*
   //users-Admin
    Route::get('/users-admin', [UsersController::class, 'admin'])->name('users.admin');
    //restore-departments
    Route::get('/departments-restore', [DepartmentsController::class, 'restore_index'])->name('departments.restore.index');
    Route::get('/departments/restore/do', [DepartmentsController::class, 'restore'])->name('departments.restore');
    //restore-orders
    Route::get('/orders-restore', [OrdersController::class, 'restore_index'])->name('orders.restore.index');
    Route::get('/orders/restore/do', [OrdersController::class, 'restore'])->name('orders.restore');
    //autocompleteSearch-departments
    Route::get('/autocomplete-search-departments', [DepartmentsController::class, 'autocompleteSearch']);
    //search-departments
    Route::POST('/search-departments', [DepartmentsController::class, 'search_departments'])->name('departments.search');
    //autocompleteSearch-users
    Route::get('/autocomplete-search-users', [UsersController::class, 'autocompleteSearch']);
    //search-users
    Route::POST('/search-users', [UsersController::class, 'search_users'])->name('users.search');

    **/