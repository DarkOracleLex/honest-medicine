<?php

namespace App\Services;

use App\Models\Change;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class ChangeService
{
    public function findAll(): Collection
    {
        $models = Change::all();

        abort_if(
            $models->isEmpty(),
            Response::HTTP_NOT_FOUND,
            __('http-statuses.404'),
        );

        return $models;
    }
}
