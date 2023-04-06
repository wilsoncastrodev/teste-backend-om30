<?php

namespace App\Services;

use App\Http\Requests\StorePatientRequest;
use App\Http\Resources\PatientCollection;
use App\Http\Resources\PatientPaginateCollection;
use App\Http\Resources\PatientResource;
use App\Interfaces\Services\PatientServiceInterface;
use App\Models\Patient;
use App\Repositories\PatientRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PatientService implements PatientServiceInterface
{
    private PatientRepository $patientRepository;

    public function __construct(PatientRepository $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    public function getAllPatient(): ResourceCollection
    {
        $patients = $this->patientRepository->getAllPatient();
        return new PatientCollection($patients);
    }

    public function getAllPatientPaginate(int $lenght): ResourceCollection
    {
        $patients = $this->patientRepository->getAllPatientPaginate($lenght);
        return new PatientPaginateCollection($patients);
    }

    public function getPatientById(Patient $patient): JsonResource
    {
        $patient = $this->patientRepository->getPatientById($patient);
        return new PatientResource($patient);
    }
    
    public function createPatient(Request $request): JsonResource
    {
        $patient = $this->patientRepository->createPatient($request);
        
        if($request->hasFile('photo')) {
            $request->file('photo')->storeAs('patients/photos', $patient->photo);
        }

        return new PatientResource($patient);
    }

    public function updatePatient(Request $request, Patient $patient): JsonResource
    {
        Storage::delete('patients/photos/' . $patient->photo);

        $patient = $this->patientRepository->updatePatient($request, $patient);

        if($request->hasFile('photo')) {
            $request->file('photo')->storeAs('patients/photos', $patient->photo);
        }

        return new PatientResource($patient);
    }

    public function deletePatient(Patient $patient): bool
    {
        Storage::delete('patients/photos/' . $patient->photo);

        return $this->patientRepository->deletePatient($patient);
    }
}