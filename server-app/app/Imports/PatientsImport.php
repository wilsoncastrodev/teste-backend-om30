<?php

namespace App\Imports;

use App\Models\Patient;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PatientsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $rows->shift();

        foreach ($rows as $row) 
        {
            $patientExist = Patient::where('cpf', $row[3])->orWhere('cns', $row[4])->exists();

            if(!$patientExist) {
                $patient = Patient::create([
                    'name' => $row[0],
                    'mother_name' => $row[1],
                    'birth_date' => $row[2],
                    'cpf' => $row[3],
                    'cns' => $row[4],
                ]);
    
                $patient->address()->create([
                    'zipcode' => $row[5],
                    'address' => $row[6],
                    'number' => $row[7],
                    'complement' => $row[8],
                    'neighborhood' => $row[9],
                    'city' => $row[10],
                    'state' => $row[11]
                ]);
            }
        }
    }
}