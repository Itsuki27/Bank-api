<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AccountTypeController;
use App\Http\Controllers\AuthController;

Route::post('login', [AuthController::class, 'login']);

// Protected routes
Route::middleware(['auth:api'])->group(function () {
    Route::get('check-token', [AuthController::class, 'checkToken']);
    Route::post('revoke-token', [AuthController::class, 'revokeToken']);
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']); // Retrieve all users
    Route::post('/', [UserController::class, 'store']); // Create a new user
    Route::get('/{user}', [UserController::class, 'show']); // Retrieve a specific user
    Route::patch('/{user}', [UserController::class, 'update']); // Update a specific user
    Route::delete('/{user}', [UserController::class, 'destroy']); // Delete a specific user
});

Route::prefix('transactions')->group(function () {
    Route::get('/', [TransactionController::class, 'index']); // Retrieve all transactions
    Route::post('/', [TransactionController::class, 'store']); // Create a new transaction
    Route::get('/{transaction}', [TransactionController::class, 'show']); // Retrieve a specific transaction
    Route::patch('/{transaction}', [TransactionController::class, 'update']); // Update a specific transaction
    Route::delete('/{transaction}', [TransactionController::class, 'destroy']); // Delete a specific transaction
});

Route::prefix('accounts')->group(function () {
    Route::get('/', [AccountController::class, 'index']); // Retrieve all accounts
    Route::post('/', [AccountController::class, 'store']); // Create a new account
    Route::get('/{account}', [AccountController::class, 'show']); // Retrieve a specific account
    Route::patch('/{account}', [AccountController::class, 'update']); // Update a specific account
    Route::delete('/{account}', [AccountController::class, 'destroy']); // Delete a specific account
});

Route::prefix('account-types')->group(function () {
    Route::get('/', [AccountTypeController::class, 'index']); // Retrieve all account types
    Route::post('/', [AccountTypeController::class, 'store']); // Create a new account type
    Route::get('/{accountType}', [AccountTypeController::class, 'show']); // Retrieve a specific account type
    Route::patch('/{accountType}', [AccountTypeController::class, 'update']); // Update a specific account type
    Route::delete('/{accountType}', [AccountTypeController::class, 'destroy']); // Delete a specific account type
});

