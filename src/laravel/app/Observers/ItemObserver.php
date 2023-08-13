<?php

namespace App\Observers;

use App\Models\Change;
use App\Models\Item;

class ItemObserver
{
    public function created(Item $item): void
    {
        Change::create([
            'event_type' => 'created',
            'model' => $item->getModelName(),
            'model_id' => $item->id,
        ]);
    }

    public function updated(Item $item): void
    {
        Change::create([
            'event_type' => 'updated',
            'model' => $item->getModelName(),
            'model_id' => $item->id,
            'changes' => $item->getChanges(),
        ]);
    }

    public function deleted(Item $item): void
    {
        Change::create([
            'event_type' => 'deleted',
            'model' => $item->getModelName(),
            'model_id' => $item->id
        ]);
    }
}
