<?php

namespace App\Interfaces\Services;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

interface PatientServiceInterface
{
    /**
     * Serviço para consultar todos os Pacientes
     *
     * @param null Não há parâmetros
     *
     * @return Collection Pacientes que foram encontrados.
     */
    public function getAllPatient(): ResourceCollection;

    /**
     * Serviço para consultar todos os Pacientes com Paginação
     *
     * @param int $length Quantidade de Paciente por Página
     *
     * @return LengthAwarePaginator Pacientes que foram encontrados.
     */
    public function getAllPatientPaginate(int $length): ResourceCollection;

    /**
     * Serviço para consultar um Paciente por meio do ID
     *
     * @param Patient $patient Objeto Paciente
     *
     * @return ResourceCollection Paciente que foi encontrado.
     */
    public function getPatientById(Patient $patient): JsonResource;

    /**
     * Serviço para buscar Pacientes por meio do Nome ou CPF
     *
     * @param mixed $query Nome ou CPF do paciente
     *
     * @return ResourceCollection Os pacientes que foram encontrados.
     */
    public function searchPatient(mixed $query): ResourceCollection;

    /**
     * Serviço para buscar Pacientes por meio do Nome ou CPF com Paginação
     *
     * @param mixed $query Nome ou CPF do paciente
     * @param int $length Quantidade de Paciente por Página
     *
     * @return ResourceCollection Os pacientes que foram encontrados.
     */
    public function searchPatientPaginate(mixed $query, int $length): ResourceCollection;

    /**
     * Serviço para criar um novo Paciente
     *
     * @param Request Objeto Paciente da Requisição
     *
     * @return JsonResource Paciente que foi armazenado.
     */
    public function createPatient(Request $request): JsonResource;

    /**
     * Serviço para atualizar um Paciente
     *
     * @param StorePatientRequest $request Objeto Paciente da Requisição
     * @param Patient $patient Objeto Paciente
     *
     * @return JsonResource Paciente que foi atualizado.
     */
     public function updatePatient(Request $request, Patient $patient): JsonResource;

    /**
     * Serviço para excluir um Paciente por meio do ID
     *
     * @param Patient $patient Objeto Paciente
     *
     * @return void Não há retorno.
     */
    public function deletePatient(Patient $patient): bool;

    /**
     * Serviço para importar pacientes de um arquivo CSV
     *
     * @param Request $request Requisão com arquivo CSV
     *
     * @return void Não há retorno.
     */
    public function importPatients(Request $request): void;
}
