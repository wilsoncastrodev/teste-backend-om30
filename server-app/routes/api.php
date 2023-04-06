<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientController;

Route::prefix('v1')->group(function () {
    Route::get('patients', [PatientController::class, 'index']);
    Route::get('patients/{patient}', [PatientController::class, 'show']);
    Route::get('patients/paginate/{lenght}', [PatientController::class, 'paginate']);
    Route::post('patients', [PatientController::class, 'store']);
    Route::patch('patients/{patient}', [PatientController::class, 'update']);
    Route::delete('patients/{patient}', [PatientController::class, 'destroy']);
});

