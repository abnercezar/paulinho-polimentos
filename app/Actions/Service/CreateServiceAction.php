<?php

namespace App\Actions\Service;

use App\Models\Service;

class CreateServiceAction
{
    /**
     * Executa a ação de criar um novo serviço.
     */
    public function execute(array $data): Service
    {
        // Aqui pode adicionar lógica extra, como eventos, validações customizadas, etc.
        return Service::create($data);
    }
}
