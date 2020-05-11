<?php

namespace Tests\Feature\Addresses;

use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_fials_if_unauthenticated()
    {
        $this->json('GET', 'api/addresses')

            ->assertStatus(401);
    }

    public function test_it_show_addresses()
    {
        $user = factory(User::class)->create();

        $address = factory(Address::class)->create([
            'user_id' => $user->id
        ]);

        $this->jsonAs($user, 'GET', 'api/addresses')

            ->assertJsonFragment([
                'id' => $address->id
            ]);
    }
}
