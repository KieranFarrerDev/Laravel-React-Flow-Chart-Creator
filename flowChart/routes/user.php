<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('users')->group(function () {
    Route::post('{uuid}/permissions', [UserController::class, 'updatePermissions'])
        ->name('flowchart.updatePermissions');
});
