<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedSessionController;
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

Route::delete('/spots/{spot}', [ SpotController::class, 'destroy' ])->middleware('auth:sanctum,creator');

Route::get('/categories', [ CategoryController::class, 'index' ]);

Route::get('/categories/{category}', [CategoryController::class, 'show']);

Route::get('/categories/{category}/spots', [ CategoryController::class, 'spots' ]);

Route::post('/register', [ RegisteredUserController::class, 'store']);

Route::post('/opinions', [ UserController::class, 'getOpinions'])->middleware('auth:sanctum');

Route::post('/recommend', [ UserController::class, 'recommend' ])->middleware('auth:sanctum');

Route::post('/rate', [UserController::class, 'rate'])->middleware('auth:sanctum');

Route::post('/comment', [UserController::class, 'comment'])->middleware('auth:sanctum');

Route::post('/visits', [UserController::class, 'visits'])->middleware('auth:sanctum');

Route::get('/visits', [UserController::class, 'getVisits'])->middleware('auth:sanctum');

Route::get('/recommendations', [ SpotController::class, 'getRecommendations' ]);

Route::get('/valorations', [ SpotController::class, 'getValorations' ]);

Route::group(['middleware' => ['web'] ], function () {
    Route::post('/login', [ AuthenticatedSessionController::class, 'store' ]);
    Route::post('/login-creators', [ AuthenticatedSessionController::class, 'creatorLogin' ]);
});

Route::prefix('user')->group( function() {
    Route::post('/forgot-password', [ AuthenticationController::class, 'sendPasswordResetToken' ])->name('api-reset-password');
    Route::post('/reset-password-token', [ AuthenticationController::class, 'validatePasswordResetToken' ])->name('api-reset-password-token');
    Route::post('/new-password', [ AuthenticationController::class, 'setNewAccountPassword' ])->name('new-account-password');
});
