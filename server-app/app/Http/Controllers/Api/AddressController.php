<?php

namespace App\Http\Controllers\Api;

use \Exception;
use App\Services\AddressService;
use App\Http\Requests\SearchAddressRequest;
use Illuminate\Http\Response;

class AddressController extends BaseController
{
    private AddressService $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function searchAddress(SearchAddressRequest $request): Response
    {
        try {
            $address = $this->addressService->searchAddressByZipcode($request);
            return empty($address['erro']) ? $this->sendResponse($address) : $this->sendError('Endereço não encontrado!');
        } catch (Exception $e) {
            return $this->sendErrorException($e);
        }
    }
}
