<?php

namespace Tests\Unit;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use Tests\TestCase;

class RoomCreation extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function CreateRoom(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->get('/login');
        $response->assertStatus(200);

        $room = new Room([
            'name' => 'Room',
            'description' => 'Description',
        ]);
        $hotel_id = Hotel::get()->random()->id;

        $response = $this->post($hotel_id . '/rooms', $room->toArray());
        $response->assertStatus(200);
    }
}
