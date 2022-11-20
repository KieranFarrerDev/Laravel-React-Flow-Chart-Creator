<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlowChartController;

Route::prefix('flow-chart')->group(function () {
    Route::match(['GET', 'POST'], '/', [FlowChartController::class, 'index'])->name('flowchart.index');
});
