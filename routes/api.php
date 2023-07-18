<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\EmployeeController;

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

Route::prefix("v1")->group(function () {
    Route::group(['as' => 'Api.','middleware'=>"auth:sanctum"], function () {
        Route::apiResources([
            'users' => UserController::class,
        ]);
    });
    Route::apiResources([
        'companies' => CompanyController::class,
        'employees' => EmployeeController::class
    ]);
    Route::post('/register', [UserController::class,'register']);
    Route::post('/login',[UserController::class,'login']);
    
}); 

