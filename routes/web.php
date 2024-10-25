<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;


    Route::get('/foods/{id}', [FoodController::class, 'detailFood'])->name('detail');


Route::resource('category', CategoryController::class)->middleware('auth');

Route::resource('food',FoodController::class)->middleware('auth');

Route::resource('ingredient', IngredientController::class);

Auth::routes(['register']);

Route::get('/', [FoodController::class, 'listFood']);

// Route::resource('/category', 'CategoryController::class')->middleware('auth');
// Route::resource('/food', 'FoodController::class')->middleware('auth');

// Auth::routes(['register'=>false]);

//Route::get('/foods/{id}', 'FoodController@detailFood')->name('detail');   