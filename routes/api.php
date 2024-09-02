<?php

use App\Http\Controllers\API\Admin\ExpenseController;
use App\Http\Controllers\API\Admin\PartnerController;
use App\Http\Controllers\API\Admin\ContractController;
use App\Http\Controllers\API\Auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/users', [AuthController::class, 'index'])->middleware(['auth:sanctum']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/insert-user', [AuthController::class, 'insertUser'])->middleware(['auth:sanctum']);
Route::delete('/delete-user/{user}', [AuthController::class, 'deleteUser'])->middleware(['auth:sanctum']);
Route::get('/profile', [AuthController::class, 'profile'])->middleware(['auth:sanctum']);
Route::put('/profile/{profile}', [AuthController::class, 'updateProfile'])->middleware(['auth:sanctum']);

// Route::apiResource('expenses', ExpenseController::class)->middleware(['auth:sanctum']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('expenses', ExpenseController::class);
    Route::apiResource('partners', PartnerController::class);
    Route::apiResource('partners.contracts', ContractController::class);
});
