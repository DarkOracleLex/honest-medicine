<?php

namespace Tests\Feature\Controllers;

use App\Models\Item;
use App\Models\User;
use Tests\TestCase;

class ItemControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('api/item')->assertOk()->assertJsonCount(Item::all()->count());
    }

    public function testStore()
    {
        $user = User::factory()->create();
        $item = Item::factory()->definition();

        $this->actingAs($user)->post('api/item', $item)->assertCreated();

        $this->assertDatabaseHas('items', $item);
    }

    public function testShow()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $this->actingAs($user)->get("api/item/$item->id")->assertOk()->assertJson($item->toArray());
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
    }

    public function testDestroy()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $this->actingAs($user)->delete("api/item/$item->id")->assertOk();

        $this->assertDatabaseMissing('items', [
            'id' => $item->id,
        ]);
    }
}
