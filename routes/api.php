<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SubscriptionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('device/register', [DeviceController::class, 'register']);
Route::post('purchase', [PurchaseController::class, 'purchase']);
Route::post('subscription/check', [SubscriptionController::class, 'check']);