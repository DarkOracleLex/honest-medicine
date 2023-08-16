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

        $this->get('api/item', headers: ['Accept' => 'application/json'])->assertUnauthorized();

        $this->actingAs($user)->get('api/item', headers: ['Accept' => 'application/json'])
            ->assertOk()->assertJsonCount(Item::all()->count(), 'data');
    }

    public function testStore()
    {
        $user = User::factory()->create();
        $item = Item::factory()->definition();

        $this->post('api/item', $item, ['Accept' => 'application/json'])->assertUnauthorized();

        $response = $this->actingAs($user)->post('api/item', $item, ['Accept' => 'application/json']);
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

        $this->get("api/item/$item->id", headers: ['Accept' => 'application/json'])->assertUnauthorized();

        $this->actingAs($user)->get("api/item/$item->id", headers: ['Accept' => 'application/json'])
            ->assertOk()->assertJsonFragment($item->toArray());
    }

    public function testUpdate()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $updatingData = collect(Item::factory()->definition())->only('name', 'key');

        $this->put("api/item/$item->id", $updatingData->toArray(), ['Accept' => 'application/json'])
            ->assertUnauthorized();

        $this->actingAs($user)->put("api/item/$item->id", $updatingData->toArray(), ['Accept' => 'application/json'])
            ->assertOk();

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

        $this->delete("api/item/$item->id", headers: ['Accept' => 'application/json'])->assertUnauthorized();

        $this->actingAs($user)->delete("api/item/$item->id", headers: ['Accept' => 'application/json'])->assertOk();

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
