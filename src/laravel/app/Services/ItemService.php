<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class ItemService
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

    public function create(array $validatedValues): Item
    {
        return Item::create($validatedValues);
    }

    public function update(array $validatedValues, Item $model): Item
    {
        $model->update($validatedValues);

        return $model;
    }

    public function delete(item $model): Item
    {
        abort_if(
            !$model->delete(),
            Response::HTTP_CONFLICT,
            'Не получилось удалить',
        );

        return $model;
    }
}
