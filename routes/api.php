<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SpotController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/spots', [ SpotController::class, 'index' ]);

Route::get('/spots/{spot}', [ SpotController::class, 'show' ]);

Route::get('/categories', [ CategoryController::class, 'index' ]);

Route::get('/categories/{category}', [CategoryController::class, 'show']);

Route::get('/categories/{category}/spots', [ CategoryController::class, 'spots' ]);