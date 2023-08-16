<?php

namespace Tests\Feature\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemControllerTest extends TestCase
{
    use WithFaker;

    public function testIndex()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('api/item')->assertOk()->assertJsonCount(Item::all()->count(), 'data');
    }

//    public function testStoreConflict()
//    {
//        $user = User::factory()->create();
//
//        $this->actingAs($user)->post('api/item')->assertConflict();
//    }

    public function testStore()
    {
        $user = User::factory()->create();
        $item = Item::factory()->definition();

        $response = $this->actingAs($user)->post('api/item', $item);
        $response->assertOk();

        $this->assertDatabaseHas('items', $item);
        $this->assertDatabaseHas('changes', [
            'event_type' => 'created',
            'model' => Model::getActualClassNameForMorph(Item::class),
            'model_id' => $response->json('data.id'),
        ]);
    }

    public function testShow()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $this->actingAs($user)->get("api/item/$item->id")->assertOk()->assertJsonFragment($item->toArray());
    }

    public function testUpdate()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $updatingData = collect(Item::factory()->definition())->only('name', 'key');

        $this->actingAs($user)->put("api/item/$item->id", $updatingData->toArray())->assertOk();

        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'name' => $updatingData['name'],
            'key' => $updatingData['key'],
        ]);
        $this->assertDatabaseHas('changes', [
            'event_type' => 'updated',
            'model' => Model::getActualClassNameForMorph(Item::class),
            'model_id' => $item->id,
            'changes' => json_encode($updatingData),
        ]);
    }

    public function testDestroy()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $this->actingAs($user)->delete("api/item/$item->id")->assertOk();

        $this->assertDatabaseMissing('items', [
            'id' => $item->id,
        ]);
        $this->assertDatabaseHas('changes', [
            'event_type' => 'deleted',
            'model' => Model::getActualClassNameForMorph(Item::class),
            'model_id' => $item->id,
        ]);
    }
}
