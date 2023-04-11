<?php

namespace App\Jobs;

use App\Imports\PatientsImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ImportPatients implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $filepath;

    /**
     * Create a new job instance.
     */
    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Iniciado importação de Pacientes. Job: ' . $this->job->getJobId());
        Excel::import(new PatientsImport, $this->filepath);
        Log::info('Finalizado a importação de Pacientes. Job: ' . $this->job->getJobId());
    }
}
