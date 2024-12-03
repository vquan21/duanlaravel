<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Admin route
Route::prefix("admin")
->middleware('admin')
->group(function () {
    Route::get("home", [AdminController::class, "index"])->name("admin.home");
});


Route::prefix("client")->group(function () {
    Route::get("home", [HomeController::class, "index"])->name("client.home");

    Route::get("register", [AccountController::class, "add"])->name("client.register.add");
    Route::post("register/post", [AccountController::class, "store"])->name("client.register.store");
    Route::get("login", [AccountController::class, "loginForm"])->name("client.login.add");
    Route::post("login/post", [AccountController::class, "login"])->name("client.login.store");
});
