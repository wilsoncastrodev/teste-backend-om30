<?php

namespace App\Repositories;

use App\Interfaces\Repositories\AddressRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AddressRepository implements AddressRepositoryInterface
{
    public function searchAddressByZipcode(string $zipcode): array
    {
        return Cache::rememberForever('patients' . $zipcode, function() use ($zipcode) {
            $response = Http::get("https://viacep.com.br/ws/$zipcode/json/");
            return $response->json();
        });
    }
}