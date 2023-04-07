<?php 

namespace Tests\Repositories;

use App\Repositories\AddressRepository;
use Tests\TestCase;

class AddressRepositoryTest extends TestCase
{
    protected $addressRepository;

    public function setUp() : void
    {
        parent::setUp();
        // $this->markTestSkipped('Teste desativado.');
        $this->addressRepository = app()->make(AddressRepository::class);
    }

    public function testSearchAddressByZipcodeRepository()
    {
        $zipcodeRequest = "04756-090";

        $foundAddress = $this->addressRepository->searchAddressByZipcode($zipcodeRequest);

        $this->assertEquals(
            $zipcodeRequest, 
            $foundAddress['cep'], 
            'O CEP da requisição deve ser o mesmo CEP do Endereço retornado do ViaCep'
        );
    }
}
