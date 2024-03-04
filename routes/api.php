<?php

use App\Models\EntityTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TownController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\EntityTypeController;
use App\Http\Controllers\MedicalInformationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('djaka')->group(function(){
    Route::post('/register', [AuthController::class, 'register']);
});


Route::prefix('admin')->group(function(){
    Route::middleware(['auth:api', 'admin:api'])->group(function(){
        Route::get('/countries/{id}', [CountryController::class, 'get']);
        Route::post('/countries', [CountryController::class, 'store']);
        Route::put('/countries/{country}', [CountryController::class, 'update']);
        Route::delete('/countries/{country}', [CountryController::class, 'delete']);

        Route::get('/cities/{id}', [CityController::class, 'get']);
        Route::post('/cities', [CityController::class, 'store']);
        Route::put('/cities/{city}', [CityController::class, 'update']);
        Route::delete('/cities/{city}', [CityController::class, 'delete']);

        Route::get('/towns/{id}', [TownController::class, 'get']);
        Route::post('/towns', [TownController::class, 'store']);
        Route::put('/towns/{town}', [TownController::class, 'update']);
        Route::delete('/towns/{town}', [TownController::class, 'delete']);

        Route::get('/entity-types/{id}', [EntityTypeController::class, 'get']);
        Route::post('/entity-types', [EntityTypeController::class, 'store']);
        Route::put('/entity-types/{entityType}', [EntityTypeController::class, 'update']);
        Route::delete('/entity-types/{entityType}', [EntityTypeController::class, 'delete']);

        Route::get('/roles', [RoleController::class, 'index']);
        Route::get('/roles/{id}', [RoleController::class, 'get']);
        Route::post('/roles', [RoleController::class, 'store']);
        Route::put('/roles/{role}', [RoleController::class, 'update']);
        Route::delete('/roles/{role}', [RoleController::class, 'delete']);

        route::get('/users',[UserController::class, 'index'] );
    });

});


Route::prefix('djaka')->group(function(){

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/update-registered-user', [AuthController::class, 'updateRegisteredUser']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOTP']);
    Route::post('/resend-otp/{user}', [AuthController::class, 'resendOTP']);
    Route::post('/forget-password', [AuthController::class, 'forgetPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);

    //Countries
    Route::get('/countries', [CountryController::class, 'index']);

    //City
    Route::get('/cities', [CityController::class, 'index']);

    //Town
    Route::get('/towns', [TownController::class, 'index']);

    //Entity type
    Route::get('/entity-types', [EntityTypeController::class, 'index']);

    Route::post('/medical-informations/update', [MedicalInformationController::class, 'update']);

    Route::middleware(['auth:api'])->group(function(){

        Route::post('/logout', [AuthController::class, 'logout']);

        // Route::get('/medical-informations', [MedicalInformationController::class, 'index']);
        Route::post('/medical-informations', [MedicalInformationController::class, 'store']);
        Route::get('/medical-informations/personal', [MedicalInformationController::class, 'get']);

        Route::get('/entities', [EntityController::class, 'index']);
        Route::get('/entities/{id}', [EntityController::class, 'get']);
        Route::post('/entities', [EntityController::class, 'store']);
        Route::put('/entities/{entity}', [EntityController::class, 'update']);
        Route::delete('/entities/{entity}', [EntityController::class, 'delete']);
    });

});
