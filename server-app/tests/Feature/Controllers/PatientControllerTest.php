<?php 

namespace Tests\Controllers;

use App\Helpers\Helper;
use App\Http\Controllers\Api\PatientController;
use App\Models\Address;
use App\Models\Patient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PatientControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
        // $this->markTestSkipped('Teste desativado.');
    }

    public function testGetAllPatientApi()
    {
        $patient = Patient::factory()->count(10)->has(Address::factory())->create(); 

        $response = $this->get('api/v1/patients');
        
        $response->assertStatus(200);
        $response->assertOk();
    }

    public function testGetAllPatientPaginateApi()
    {
        $patient = Patient::factory()->count(10)->has(Address::factory())->create(); 

        $response = $this->get('api/v1/patients/paginate/5');
        
        $response->assertStatus(200);
        $response->assertOk();
    }

    public function testGetPatientById()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create(); 
        $storedPatientRequest = $storedPatients->first();

        $response = $this->get("api/v1/patients/$storedPatientRequest->id");
        
        $response->assertStatus(200);
        $response->assertOk();
    }

    public function testSearchPatientByNameService()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create();
        $storedPatientRequest = $storedPatients->first();

        sleep(2); // tempo necessário para indexação dos pacientes pelo ElasticSearch

        $response = $this->get("api/v1/patients/search/$storedPatientRequest->name");

        $response->assertStatus(200);
        $response->assertOk();
    }

    public function testSearchPatientByCpfService()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create();
        $storedPatientRequest = $storedPatients->first();

        sleep(2); // tempo necessário para indexação dos pacientes pelo ElasticSearch

        $response = $this->get("api/v1/patients/search/$storedPatientRequest->cpf");

        $response->assertStatus(200);
        $response->assertOk();
    }

    public function testSearchPatientByNamePaginateService()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create();
        $storedPatientRequest = $storedPatients->first();

        sleep(2); // tempo necessário para indexação dos pacientes pelo ElasticSearch

        $response = $this->get("api/v1/patients/search/$storedPatientRequest->name/paginate/6");

        $response->assertStatus(200);
        $response->assertOk();
    }

    public function testSearchPatientByCpfPaginateService()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create();
        $storedPatientRequest = $storedPatients->first();

        sleep(2); // tempo necessário para indexação dos pacientes pelo ElasticSearch

        $response = $this->get("api/v1/patients/search/$storedPatientRequest->cpf/paginate/6");

        $response->assertStatus(200);
        $response->assertOk();
    }

    public function testCreateAPatientApi()
    {
        $patient = Patient::factory()->make()->toArray();
        $address = Address::factory()->make()->toArray();
        $photo = UploadedFile::fake()->create('foto.jpeg');
        
        $patientRequest = array_merge($patient, $address);
        $patientRequest['photo'] = $photo;

        $response = $this->post('api/v1/patients', $patientRequest);
        $response->assertStatus(201);
        $response->assertCreated();
    }

    public function testUpdateAPatientApi()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create();
        $storedPatientRequest = $storedPatients->first();
        
        $patient = Patient::factory()->make()->toArray();
        $address = Address::factory()->make()->toArray();
        $photo = UploadedFile::fake()->create('foto.jpeg');
        
        $patientRequest = array_merge($patient, $address);
        $patientRequest['photo'] = $photo;

        $response = $this->patch("api/v1/patients/$storedPatientRequest->id", $patientRequest);
        $response->assertStatus(200);
        $response->assertOk();
    }

    public function testDeleteAPatientApi()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create();
        $storedPatientRequest = $storedPatients->first();
        
        $response = $this->delete("api/v1/patients/$storedPatientRequest->id");
        $response->assertStatus(200);
        $response->assertOk();
    }

    public function testImportPatientsApi()
    {
        $path = public_path('tests/test-import-patients.csv');
        $file = new UploadedFile($path, "test-import-patients.csv", "csv", null, true);

        $response = $this->post('/api/v1/patients/import', [
            'file' => $file,
        ]);

        $response->assertStatus(200);
        $response->assertOk();
    }
}