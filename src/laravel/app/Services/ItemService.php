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

    public function findOne(int $id): Item
    {
        $model = Item::find($id);

        abort_if(
            !$model,
            Response::HTTP_NOT_FOUND,
            __('http-statuses.404')
        );

        return $model;
    }

    public function create(array $validatedValues): Item
    {
        return Item::create($validatedValues);
    }

    public function update(array $validatedValues, int $id): Item
    {
        $model = $this->findOne($id);

        $model->update($validatedValues);

        return $model;
    }

    public function delete(int $id): Item
    {
        $model = $this->findOne($id);

        abort_if(
            !$model->delete(),
            Response::HTTP_CONFLICT,
            'Не получилось удалить',
        );

        return $model;
    }
}
