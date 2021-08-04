<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

require __DIR__ . '/auth.php';

Route::get('/{any}', [AppController::class, 'index'])->where('any', '.*');
