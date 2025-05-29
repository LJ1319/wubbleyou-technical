<?php

use App\Http\Controllers\NumberController;
use Illuminate\Support\Facades\Route;

Route::post('/store-numbers', [NumberController::class, 'store']);
