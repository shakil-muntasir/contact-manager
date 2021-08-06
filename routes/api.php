<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/contacts', ContactController::class)->names('contacts');
});
