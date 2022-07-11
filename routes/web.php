<?php

use Illuminate\Support\Facades\Route;
use App\Http\Resources\OrganizationResource;
use App\Models\Organization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // dd(new OrganizationResource(Organization::with(['positions'])->get(['id', 'name'])));
    return view('welcome');
});
Route::resource('position-web', \App\Http\Controllers\Api\PositionController::class);
