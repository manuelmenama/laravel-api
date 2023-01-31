<?php

use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\PageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')
    ->prefix('projects')
    ->group(function(){
        Route::get('/', [PageController::class, 'index']);
        Route::get('/search', [PageController::class, 'search']);
        Route::get('/project-type/{id}', [PageController::class, 'getByType']);
        Route::get('/project-tecnology/{id}', [PageController::class, 'getByTecnology']);
        Route::get('/{slug}', [PageController::class, 'show']);
    });

Route::post('/contacts', [LeadController::class, 'store']);
