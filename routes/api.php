<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/spots', [ SpotController::class, 'index' ]);

Route::get('/spots/{spot}', [ SpotController::class, 'show' ]);

Route::get('/categories', [ CategoryController::class, 'index' ]);

Route::get('/categories/{category}', [CategoryController::class, 'show']);

Route::get('/categories/{category}/spots', [ CategoryController::class, 'spots' ]);

Route::post('/register', [ RegisteredUserController::class, 'store']);

Route::post('/check', [ UserController::class, 'checkOptions'])->middleware('auth:sanctum');

Route::post('/recommend', [ UserController::class, 'recommend' ])->middleware('auth:sanctum');

Route::group(['middleware' => ['web'] ], function () {
    Route::post('/login', [ AuthenticatedSessionController::class, 'store' ]);
});
