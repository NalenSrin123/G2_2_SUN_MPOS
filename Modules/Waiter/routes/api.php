<?php

use Illuminate\Support\Facades\Route;
use Modules\Waiter\Http\Controllers\WaiterController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('waiters', WaiterController::class)->names('waiter');
});
