<?php

namespace App\Services;

use App\Interfaces\Services\AddressServiceInterface;
use App\Repositories\AddressRepository;
use Illuminate\Http\Request;

class AddressService implements AddressServiceInterface
{
    private AddressRepository $addressRepository;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function searchAddressByZipcode(Request $request): array
    {
        return $this->addressRepository->searchAddressByZipcode($request->zipcode);
    }
}