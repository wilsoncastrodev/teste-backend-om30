<?php

namespace App\Interfaces\Repositories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface PatientRepositoryInterface
{
    /**
     * Consulta todos os Pacientes
     *
     * @param null Não há parâmetros
     *
     * @return Collection Pacientes que foram encontrados.
     */
    public function getAllPatient(): Collection;
    
    /**
     * Consulta todos os Pacientes com Paginação
     *
     * @param null Não há parâmetros
     *
     * @return LengthAwarePaginator Pacientes que foram encontrados.
     */
    public function getAllPatientPaginate(int $lenght): LengthAwarePaginator;

    /**
     * Consulta um Paciente por meio do ID
     *
     * @param Patient $patient Objeto Paciente
     *
     * @return Patient Paciente que foi encontrado.
     */
    public function getPatientById(Patient $patient): Patient;

    /**
     * Cria um novo Paciente
     *
     * @param Request Objeto Paciente da Requisição
     *
     * @return Patient Paciente que foi armazenado.
     */
    public function createPatient(Request $request): Patient;

    /**
     * Atualiza um Paciente
     *
     * @param Request $request Objeto Paciente da Requisição
     * @param Patient $patient Objeto Paciente
     *
     * @return Patient Paciente que foi atualizado.
     */
    public function updatePatient(Request $request, Patient $patient);

    /**
     * Excluí um Paciente por meio do ID
     *
     * @param Patient $patient Objeto Paciente
     *
     * @return void Não há retorno.
     */
    public function deletePatient(Patient $patient): bool;
}
