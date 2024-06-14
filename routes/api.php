<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PegawaiApiController;

Route::apiResource('/pegawais', PegawaiApiController::class);
