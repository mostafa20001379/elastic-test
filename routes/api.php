<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('elastic')
    ->group(function () {
        Route::get('show', [\App\Http\Controllers\ElasticsearchController::class, 'index']);
        Route::post('create', [\App\Http\Controllers\ElasticsearchController::class, 'store']);
        Route::delete('delete', [\App\Http\Controllers\ElasticsearchController::class, 'delete']);
    });

Route::prefix('notifications')
    ->group(function () {
        Route::get('my-notifications', [\App\Http\Controllers\NotificationController::class, 'myNotifications']);
    });