<?php

namespace App\Interfaces\Repositories;

interface AddressRepositoryInterface
{
    /**
     * Busca o Endereço por meio do CEP utilizando a API ViaCep
     *
     * @param string $zipcode CEP da Requisição
     *
     * @return array Endereço que foi encontrado.
     */
    public function searchAddressByZipcode(string $zipcode): array;
}
