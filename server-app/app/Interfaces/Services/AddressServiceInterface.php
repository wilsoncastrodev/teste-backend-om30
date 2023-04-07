<?php

namespace App\Interfaces\Services;

use Illuminate\Http\Request;

interface AddressServiceInterface
{
    /**
     * Serviço para buscar o Endereço por meio do CEP
     *
     * @param Request $request CEP da Requisição
     *
     * @return array Endereço que foi encontrado.
     */
    public function searchAddressByZipcode(Request $request): array;
}
