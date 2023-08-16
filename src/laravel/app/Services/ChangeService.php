<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class ChangeService
{
    public function findAll(): Collection
    {
        $models = Item::all();

        abort_if(
            $models->isEmpty(),
            Response::HTTP_NOT_FOUND,
            __('http-statuses.404'),
        );

        return $models;
    }
}
