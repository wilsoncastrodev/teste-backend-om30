<?php 

namespace Tests\Services;

use App\Helpers\Helper;
use App\Models\Address;
use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PatientServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $patientService;

    public function setUp() : void
    {
        parent::setUp();
        // $this->markTestSkipped('Teste desativado.');
        $this->patientService = app()->make(PatientService::class);
    }

    public function testGetAllPatientService()
    {
        Patient::factory()->count(10)->has(Address::factory())->create(); 

        $listPatient = $this->patientService->getAllPatient();
        
        $this->assertNotEmpty($listPatient, 'A lista de pacientes retornada deve ser diferente de vazio');
        $this->assertInstanceOf(
            ResourceCollection::class, 
            $listPatient, 
            'A lista de objetos de Paciente retornada deve ser uma instância da classe ResourceCollection'
        );
    }
    
    public function testGetAllPatientPaginateService()
    {
        Patient::factory()->count(10)->has(Address::factory())->create(); 

        $listPatient = $this->patientService->getAllPatient();
        
        $this->assertNotEmpty($listPatient, 'A lista de pacientes retornada deve ser diferente de vazio');
        $this->assertInstanceOf(
            ResourceCollection::class, 
            $listPatient, 
            'A lista de objetos de Paciente retornada deve ser uma instância da classe ResourceCollection'
        );
    }

    public function testGetPatientByIdService()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create(); 
        $storedPatientRequest = $storedPatients->first();

        $foundPatient = $this->patientService->getPatientById($storedPatientRequest);
        
        $this->assertNotNull($foundPatient, 'O Paciente retornado deve ser diferente de nulo');
        $this->assertInstanceOf(
            JsonResource::class, 
            $foundPatient, 
            'O objeto Paciente retornado deve ser uma instância da classe JsonResource'
        );
    }

    public function testSearchPatientByNameService()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create();
        $storedPatientRequest = $storedPatients->first();

        sleep(2); // tempo necessário para indexação dos pacientes pelo ElasticSearch

        $foundPatient = $this->patientService->searchPatient($storedPatientRequest->name);

        $this->assertNotEmpty($foundPatient, 'A lista de pacientes retornada deve ser diferente de vazio');
        $this->assertInstanceOf(
            ResourceCollection::class, 
            $foundPatient, 
            'A lista de objetos de Paciente retornada deve ser uma instância da classe ResourceCollection'
        );
    }

    public function testSearchPatientByCpfService()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create();
        $storedPatientRequest = $storedPatients->first();

        sleep(2); // tempo necessário para indexação dos pacientes pelo ElasticSearch

        $foundPatient = $this->patientService->searchPatient($storedPatientRequest->cpf);

        $this->assertNotEmpty($foundPatient, 'A lista de pacientes retornada deve ser diferente de vazio');
        $this->assertInstanceOf(
            ResourceCollection::class, 
            $foundPatient, 
            'A lista de objetos de Paciente retornada deve ser uma instância da classe ResourceCollection'
        );
    }

    public function testSearchPatientByNamePaginateService()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create();
        $storedPatientRequest = $storedPatients->first();

        sleep(2); // tempo necessário para indexação dos pacientes pelo ElasticSearch

        $foundPatient = $this->patientService->searchPatientPaginate($storedPatientRequest->name, 5);

        $this->assertNotEmpty($foundPatient, 'A lista de pacientes retornada deve ser diferente de vazio');
        $this->assertInstanceOf(
            ResourceCollection::class, 
            $foundPatient, 
            'A lista de objetos de Paciente retornada deve ser uma instância da classe ResourceCollection'
        );
    }

    public function testSearchPatientByCpfPaginateService()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create();
        $storedPatientRequest = $storedPatients->first();

        sleep(2); // tempo necessário para indexação dos pacientes pelo ElasticSearch

        $foundPatient = $this->patientService->searchPatientPaginate($storedPatientRequest->cpf, 5);

        $this->assertNotEmpty($foundPatient, 'A lista de pacientes retornada deve ser diferente de vazio');
        $this->assertInstanceOf(
            ResourceCollection::class, 
            $foundPatient, 
            'A lista de objetos de Paciente retornada deve ser uma instância da classe ResourceCollection'
        );
    }

    public function testCreateAPatientService()
    {
        Storage::fake('public');

        $patient = Patient::factory()->make()->toArray();
        $address = Address::factory()->make()->toArray();
        $photo = UploadedFile::fake()->create('foto.jpeg');
        $patientRequest = array_merge($patient, $address);
        $patientRequest['photo'] = $photo;

        $createdPatient = $this->patientService->createPatient(new Request($patientRequest));

        $photo->storeAs('patients/photos', $createdPatient->photo);

        $this->assertNotNull($createdPatient, 'O Paciente criado deve ser diferente de nulo');
        $this->assertInstanceOf(
            JsonResource::class, 
            $createdPatient, 
            'O objeto Paciente retornado deve ser uma instância da classe JsonResource'
        );
        Storage::disk('public')->assertExists('patients/photos/' . $createdPatient->photo);
    }

    public function testUpdateAPatientService()
    {
        Storage::fake('public');

        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create();
        $storedPatientRequest = $storedPatients->first();

        $patient = Patient::factory()->make()->toArray();
        $address = Address::factory()->make()->toArray();
        $photo = UploadedFile::fake()->create('foto.jpeg');
        $patientRequest = array_merge($patient, $address);
        $patientRequest['photo'] = $photo;

        $updatedPatient = $this->patientService->updatePatient(new Request($patientRequest), $storedPatientRequest);

        $photo->storeAs('patients/photos', $updatedPatient->photo);

        $this->assertNotNull($updatedPatient, 'O Paciente atualizado deve ser diferente de nulo');
        $this->assertInstanceOf(
            JsonResource::class, 
            $updatedPatient, 
            'O objeto Paciente retornado deve ser uma instância da classe JsonResource'
        );
        Storage::disk('public')->assertExists('patients/photos/' . $updatedPatient->photo);
    }

    public function testDeleteAPatientService()
    {
        $storedPatients = Patient::factory()->count(5)->has(Address::factory())->create();
        $storedPatientRequest = $storedPatients->first();

        $deletedPatient = $this->patientService->deletePatient($storedPatientRequest);

        $this->assertTrue($deletedPatient);
    }

    public function testImportPatientsService()
    {
        Storage::fake('public');

        $path = public_path('tests/test-import-patients.csv');
        $file = new UploadedFile($path, "test-import-patients.csv", "csv", null, true);

        $request = new Request();
		$request->files->set('file', $file);

        $importPatients = $this->patientService->importPatients($request);

        $this->assertNull($importPatients);
    }
}
