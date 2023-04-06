<?php

namespace App\Observers;

use App\Models\Patient;
use Illuminate\Support\Facades\Log;

class PatientObserver
{
    public function retrieved(Patient $patient): void
    {
        Log::info("Usuário acessou um paciente", ['Dados do Paciente Recuperado' => $patient->toArray()]);
    }
    
    public function creating(): void
    {
        Log::info("Usuário está tentando criar um paciente", ['Dados da Requisição' => request()->all()]);
    }

    public function created(Patient $patient): void
    {
        Log::info("Usuário criou um paciente com sucesso", ['Dados do Paciente Criado' => $patient->toArray()]);
    }

    public function updating(): void
    {
        Log::info(
            "Usuário está tentando atualizar um paciente", 
            [
                'ID da Requisição' => (int) request()->segment(4), 
                'Dados da Requisição' => request()->all()
            ]
        );
    }

    public function updated(Patient $patient): void
    {
        Log::info("Usuário atualizou um paciente com sucesso", ['Dados do Paciente Atualizado' => $patient->toArray()]);
    }

    public function deleting(): void
    {
        Log::info(
            "Usuário está tentando excluir um paciente", 
            [
                'ID da Requisição' => (int) request()->segment(4)
            ]
        );
    }

    public function deleted(Patient $patient): void
    {
        Log::info("Usuário excluiu um paciente com sucesso", ['Dados do Paciente Excluído' => $patient->toArray()]);
    }
}
