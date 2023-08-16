<?php

namespace App\Observers;

use App\Models\Change;
use App\Models\Item;
use Illuminate\Database\Eloquent\Model;

class ItemObserver
{
    public function created(Item $item): void
    {
        Change::create([
            'event_type' => 'created',
            'model' => Model::getActualClassNameForMorph(Item::class),
            'model_id' => $item->id,
        ]);
    }

    public function updated(Item $item): void
    {
        Change::create([
            'event_type' => 'updated',
            'model' => Model::getActualClassNameForMorph(Item::class),
            'model_id' => $item->id,
            'changes' => $item->getChanges(),
        ]);
    }

    public function deleted(Item $item): void
    {
        Change::create([
            'event_type' => 'deleted',
            'model' => Model::getActualClassNameForMorph(Item::class),
            'model_id' => $item->id
        ]);
    }
}
