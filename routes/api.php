<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;
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


Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request;
    // return $request->user();
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::resource('organization', \App\Http\Controllers\Api\OrganizationController::class);
    Route::resource('position', \App\Http\Controllers\Api\PositionController::class);
    // Route::get('/organizations', function () {
    //     return new OrganizationResource(Organization::all());
    // });
});
