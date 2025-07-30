<?php

namespace App\Actions\Service;

use App\Models\Service;

class DeleteServiceAction
{
    /**
     * Exclui um serviço.
     */
    public function execute(Service $service): void
    {
        $service->delete();
    }
}
