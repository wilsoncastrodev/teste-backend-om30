<?php 

namespace Tests\Services;

use App\Services\AddressService;
use Illuminate\Http\Request;
use Tests\TestCase;

class AddressServiceTest extends TestCase
{
    protected $addressService;

    public function setUp() : void
    {
        parent::setUp();
        // $this->markTestSkipped('Teste desativado.');
        $this->addressService = app()->make(AddressService::class);
    }

    public function testSearchAddressByZipcodeService()
    {
        $zipcodeRequest = ['zipcode' => "04756-090"];

        $foundAddress = $this->addressService->searchAddressByZipcode(new Request($zipcodeRequest));

        $this->assertNotNull($foundAddress, 'O Endereço retornado deve ser diferente de nulo');
    }
}
