<?php

namespace Tests\Unit;

use App\Models\Hotel;
use App\Models\User;
use Tests\TestCase;

class HotelCreation extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function creatingHotel(): void
    {
        $user = User::first();
        $response = $this->actingAs($user)->get('/login');
        $response->assertStatus(200);

        $hotel = new Hotel([
            'name' => 'Hotel',
            'address' => 'Rua Nelson Silveira',
            'zip_code' => '85023432',
            'city' => 'Guarapuava',
            'state' => 'PR',
            'website' => 'example.com',
            'user_id' => $user->id
        ]);

        $response = $this->post('/hotels', $hotel->toArray());
        $response->assertStatus(200);
    }
}
