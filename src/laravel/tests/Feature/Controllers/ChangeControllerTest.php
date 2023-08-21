<?php

namespace Tests\Feature\Controllers;

use App\Models\Change;
use App\Models\User;
use Tests\TestCase;

class ChangeControllerTest extends TestCase
{
    public function testIndex()
    {
        $user = User::factory()->create();

        $this->get('api/change', headers: ['Accept' => 'application/json'])->assertUnauthorized();

        $this->actingAs($user)->get('api/change', headers: ['Accept' => 'application/json'])
            ->assertOk()->assertJsonFragment(['data' => Change::all()->toArray()]);
    }
}
