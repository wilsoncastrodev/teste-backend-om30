<?php

namespace App\Http\Resources;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'mother_name' => $this->mother_name,
            'birth_date' => $this->birth_date,
            'cpf' => $this->cpf,
            'cns' => $this->cns,
            'photo' => $this->photo ? Helper::getURLImage($this->photo) : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'address' => $this->address
        ];
    }
}
