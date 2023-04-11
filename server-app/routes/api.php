<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\AddressController;

Route::prefix('v1')->group(function () {
    Route::get('patients', [PatientController::class, 'index']);
    Route::get('patients/{patient}', [PatientController::class, 'show']);
    Route::get('patients/paginate/{lenght}', [PatientController::class, 'paginate']);
    Route::get('patients/search/{query}', [PatientController::class, 'searchPatient']);
    Route::get('patients/search/{query}/paginate/{lenght}', [PatientController::class, 'searchPatientPaginate']);
    Route::post('patients', [PatientController::class, 'store']);
    Route::post('patients/import', [PatientController::class, 'import']);
    Route::patch('patients/{patient}', [PatientController::class, 'update']);
    Route::delete('patients/{patient}', [PatientController::class, 'destroy']);

    Route::post('address/search', [AddressController::class, 'searchAddress']);
});

