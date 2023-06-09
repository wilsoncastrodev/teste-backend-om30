<?php

namespace App\Repositories;

use App\Http\Requests\StorePatientRequest;
use App\Interfaces\Repositories\PatientRepositoryInterface;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PatientRepository implements PatientRepositoryInterface
{
    public function getAllPatient(): Collection
    {
        return Patient::all()->sortByDesc("created_at");
    }

    public function getAllPatientPaginate(int $length): LengthAwarePaginator
    {
        return Patient::orderByDesc('created_at')->paginate($length);
    }

    public function getPatientById(Patient $patient): Patient
    {
        return $patient;
    }
    
    public function searchPatient(mixed $query): Collection
    {
        return Patient::search($query)->get();
    }
    
    public function searchPatientPaginate(mixed $query, int $length): LengthAwarePaginator
    {
        return Patient::search($query)->paginate($length);
    }
    
    public function createPatient(Request $request): Patient
    {
        $patient = Patient::create($request->all());
        $patient->address()->create($request->all());
        return $patient;
    }

    public function updatePatient(Request $request, Patient $patient): Patient
    {
        $address = $patient->address;
        $patient->update($request->all());
        $address->update($request->all());
        return $patient;
    }

    public function deletePatient(Patient $patient): bool
    {
        return $patient->delete();
    } 
}