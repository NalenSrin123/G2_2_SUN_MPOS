<?php

use Illuminate\Support\Facades\Route;
use Modules\Waiter\Http\Controllers\WaiterController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('waiters', WaiterController::class)->names('waiter');
});
