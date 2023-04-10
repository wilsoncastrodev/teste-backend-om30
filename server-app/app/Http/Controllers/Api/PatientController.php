<?php

namespace App\Http\Controllers\Api;

use \Exception;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Http\Response;

class PatientController extends BaseController
{
    private PatientService $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function index(): Response
    {
        try {
            $patients = $this->patientService->getAllPatient();
            return $this->sendResponse($patients);
        } catch (Exception $e) {
            return $this->sendErrorException($e);
        }
    }

    public function paginate(int $lenght): Response
    {
        try {
            $patients = $this->patientService->getAllPatientPaginate($lenght);
            return $this->sendResponse($patients);
        } catch (Exception $e) {
            return $this->sendErrorException($e);
        }
    }

    public function searchPatient(mixed $query): Response
    {
        try {
            $patients = $this->patientService->searchPatient($query);
            return $this->sendResponse($patients);
        } catch (Exception $e) {
            return $this->sendErrorException($e);
        }
    }

    public function searchPatientPaginate(mixed $query, int $lenght): Response
    {
        try {
            $patients = $this->patientService->searchPatientPaginate($query, $lenght);
            return $this->sendResponse($patients);
        } catch (Exception $e) {
            return $this->sendErrorException($e);
        }
    }

    public function store(StorePatientRequest $request): Response
    {
        try {
            $patient = $this->patientService->createPatient($request);
            return $this->sendResponse($patient, 201);
        } catch (Exception $e) {
            return $this->sendErrorException($e);
        }
    }

    public function show(Patient $patient): Response
    {
        try {
            $patient = $this->patientService->getPatientById($patient);
            return $this->sendResponse($patient);
        } catch (Exception $e) {
            return $this->sendErrorException($e);
        }
    }

    public function update(UpdatePatientRequest $request, Patient $patient): Response
    {
        try {
            $patient = $this->patientService->updatePatient($request, $patient);
            return $this->sendResponse($patient);
        } catch (Exception $e) {
            return $this->sendErrorException($e);
        }
    }

    public function destroy(Patient $patient): Response
    {
        try {
            $this->patientService->deletePatient($patient);
            return $this->sendResponse([]);
        } catch (Exception $e) {
            return $this->sendErrorException($e);
        }
    }
}
