<?php 

namespace Tests\Repositories;

use App\Helpers\Helper;
use App\Models\Address;
use App\Models\Patient;
use App\Repositories\PatientRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class PatientRepositoryTest extends TestCase
{
    use RefreshDatabase;
    
    protected $patientRepository;

    public function setUp() : void
    {
        parent::setUp();
        // $this->markTestSkipped('Teste desativado.');
        $this->patientRepository = app()->make(PatientRepository::class);
    }

    public function testGetAllPatientRepository()
    {
        Patient::factory()->count(10)->has(Address::factory())->create(); 

        $listPatient = $this->patientRepository->getAllPatient();
        $listAllPatient = $listPatient->toArray();

        $this->assertCount(10, $listAllPatient, 'A listagem deve conter 10 Pacientes');
        $this->assertInstanceOf(
            Collection::class, $listPatient,
            'A lista de Paciente retornado deve ser uma instância da classe Collection'
        );
    }

    public function testGetAllPatientPaginateRepository()
    {
        Patient::factory()->count(10)->has(Address::factory())->create(); 

        $listPatient = $this->patientRepository->getAllPatientPaginate(5);
        $listPatientPagination = $listPatient->toArray();

        $this->assertCount(5, $listPatientPagination['data'], 'A listagem deve conter 5 Pacientes por página');
        $this->assertEquals(10, $listPatientPagination['total'], 'A listagem deve retornar 10 pacientes do Banco de Dados');
        $this->assertInstanceOf(
            LengthAwarePaginator::class, $listPatient,
            'A lista de Paciente retornado deve ser uma instância da classe LengthAwarePaginator'
        );
    }
    
    public function testGetPatientByIdRepository()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create();
        $storedPatientRequest = $storedPatients->first();

        $foundPatient = $this->patientRepository->getPatientById($storedPatientRequest);

        $this->assertEquals(
            $storedPatientRequest->id, 
            $foundPatient->id, 
            'O ID do Paciente da requisição deve ser o mesmo ID do Paciente recuperado do Banco de Dados'
        );
        $this->assertEquals(
            $foundPatient->address->id, 
            $storedPatientRequest->address->id, 
            'O ID do Endereço do Paciente da requisição deve ser o mesmo ID do Endereço do Paciente recuperado do Banco de Dados'
        );
        $this->assertInstanceOf(
            Patient::class, $foundPatient,
            'O Paciente encontrado deve ser uma instância da classe Patient'
        );
    }

    public function testCreateAPatientRepository()
    {
        $patient = Patient::factory()->make()->toArray();
        $address = Address::factory()->make()->toArray();
        $photo = UploadedFile::fake()->create('foto.jpeg');
        $patientRequest = array_merge($patient, $address);
        $patientRequest['photo'] = $photo;
        
        $createdPatient = $this->patientRepository->createPatient(new Request($patientRequest));

        $patient['birth_date'] = Helper::dateFormatYMD($patient['birth_date']);

        $this->assertDatabaseHas('patients', $patient);
        $this->assertDatabaseHas('addresses', $address);
    }

    public function testUpdateAPatientRepository()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create();
        $storedPatientRequest = $storedPatients->first();

        $patient = Patient::factory()->make()->toArray();
        $address = Address::factory()->make()->toArray();
        $photo = UploadedFile::fake()->create('foto.jpeg');
        $patientRequest = array_merge($patient, $address);
        $patientRequest['photo'] = $photo;

        $updatedPatient = $this->patientRepository->updatePatient(new Request($patientRequest), $storedPatientRequest);

        $patient['birth_date'] = Helper::dateFormatYMD($patient['birth_date']);

        $this->assertDatabaseHas('patients', $patient);
        $this->assertDatabaseHas('addresses', $address);
    }
    
    public function testDeleteAPatientRepository()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create();
        $storedPatientRequest = $storedPatients->first();
        $storedPatientId = $storedPatientRequest->id;
        $storedPatientAddressId = $storedPatientRequest->address->id;

        $deletedPatient = $this->patientRepository->deletePatient($storedPatientRequest);

        $this->assertTrue($deletedPatient);
        $this->assertDatabaseCount('patients', 4);
        $this->assertDatabaseMissing('patients', ['id' => $storedPatientId]);
        $this->assertDatabaseCount('addresses', 4);
        $this->assertDatabaseMissing('addresses', ['id' => $storedPatientAddressId]);
    }
}
