<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;

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

Route::get('employee', [EmployeeController::class, 'index']);
Route::post('employee', [EmployeeController::class, 'store']);
Route::put('employee/update/{id}', [EmployeeController::class, 'update']);
Route::delete('employee/delete/{id}', [EmployeeController::class, 'delete']);
Route::get('employee/view/{id}', [EmployeeController::class, 'view']);

// Sort and Search
Route::get('employee/sort', [EmployeeController::class, 'sort']);
Route::get('employee/search', [EmployeeController::class, 'search']);