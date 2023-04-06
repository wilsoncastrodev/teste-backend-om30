<?php 

namespace Tests\Models;

use App\Models\Address;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
        // $this->markTestSkipped('Teste desativado.');
    }

    public function testAPatientHasOneAddress()
    {
        $patient = Patient::factory()->create(); 
        $address = Address::factory()->create(['patient_id' => $patient->id]);

        $this->assertInstanceOf(
            Address::class, 
            $patient->address, 
            'O objeto Endereço do Paciente criado deve ser uma instância da classe Address'
        );
        $this->assertEquals(
            $address->id, 
            $patient->address->id, 
            'O ID do Endereço criado deve ser o mesmo do ID do Endereço do Paciente'
        );
    }
}
