<?php

use Illuminate\Support\Facades\Route;

Route::get("/uis/app", [\Adminka\AmoCRM\Http\Controllers\AmoAppController::class, "uisApp"]);
Route::get("/uis/auth", [\Adminka\AmoCRM\Http\Controllers\AmoAppController::class, "uisAuth"]);
