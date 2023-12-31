<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodolistController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuestMiddleware;
use App\Http\Middleware\OnlyMemberMiddleware;
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

Route::view("/", "welcome");

Route::get('/home', [HomeController::class, "home"]);

Route::view('/template', "template");

Route::controller(UserController::class)->group(function () {
    Route::get("/login", "login")->middleware([OnlyGuestMiddleware::class]);
    Route::post("/login", "goLogin")->middleware([OnlyGuestMiddleware::class]);
    Route::post("/logout", "goLogout")->middleware([OnlyMemberMiddleware::class]);
});
Route::controller(TodolistController::class)->middleware(OnlyMemberMiddleware::class)
    ->group(function () {
        Route::get('/todolist',"todoList");
        Route::post('/todolist',"insTodo");
        Route::post('/todolist/{id}/delete',"delTodo");
    });
