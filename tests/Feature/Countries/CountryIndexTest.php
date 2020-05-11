<?php

namespace Tests\Feature\Countries;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountryIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_returns_countries()
    {
        $country = factory(Country::class)->create();
        
        $this->json('GET', 'api/countries')

        ->assertJsonFragment([
            'id' => $country->id
        ]);
    }
}
