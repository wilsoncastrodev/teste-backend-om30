<?php 

namespace Tests\Controllers;

use Tests\TestCase;

class AddressControllerTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        // $this->markTestSkipped('Teste desativado.');
    }

    public function testSearchAddressByZipcode()
    {
        $zipcodeRequest = ['zipcode' => "04756-090"];

        $response = $this->post('api/v1/address/search', $zipcodeRequest);
        $response->assertStatus(200);
        $response->assertOk();
    }
}