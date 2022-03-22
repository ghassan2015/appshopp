<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Api\AuthController;


Route::group(['middleware' => ['api','changeLanguage'], 'namespace' => 'Api'], function () {

    Route::post('/category',[\App\Http\Controllers\Api\CategoryController::class,'index']);
    Route::get('/subcategory/',[\App\Http\Controllers\Api\CategoryController::class,'subCategory']);
    Route::get('/home/',[\App\Http\Controllers\Api\HomeController::class,'index']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/books',[\App\Http\Controllers\Api\BooksController::class,'index']);
    Route::post('/book/detail',[\App\Http\Controllers\Api\BooksController::class,'Details']);
    Route::post('/carts',[\App\Http\Controllers\Api\CartController::class,'addToCart']);
    Route::post('/getCart',[\App\Http\Controllers\Api\CartController::class,'getCart']);
    Route::post('/cart/delete',[\App\Http\Controllers\Api\CartController::class,'destroy']);


});
