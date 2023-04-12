<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Http\Requests\StorePatientRequest;
use App\Http\Resources\PatientCollection;
use App\Http\Resources\PatientPaginateCollection;
use App\Http\Resources\PatientResource;
use App\Interfaces\Services\PatientServiceInterface;
use App\Jobs\ImportPatients;
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

    public function getAllPatientPaginate(int $length): ResourceCollection
    {
        $patients = $this->patientRepository->getAllPatientPaginate($length);
        return new PatientPaginateCollection($patients);
    }

    public function getPatientById(Patient $patient): JsonResource
    {
        $patient = $this->patientRepository->getPatientById($patient);
        return new PatientResource($patient);
    }

    public function searchPatient(mixed $query): ResourceCollection
    {
        $query = Helper::removeAccentsSpecialCharacters($query);
        $patients = $this->patientRepository->searchPatient($query);
        return new PatientCollection($patients);
    }

    public function searchPatientPaginate(mixed $query, int $length): ResourceCollection
    {
        $query = Helper::removeAccentsSpecialCharacters($query);
        $patients = $this->patientRepository->searchPatientPaginate($query, $length);
        return new PatientPaginateCollection($patients);
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

    public function importPatients(Request $request): void
    {
        $filepath = $request->file('file')->storeAs('patients/files', Helper::generateFileName($request->file('file')));
        ImportPatients::dispatch($filepath);
    }
}