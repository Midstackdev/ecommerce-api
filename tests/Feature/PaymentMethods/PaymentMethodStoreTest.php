<?php

namespace Tests\Feature\PaymentMethods;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentMethodStoreTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_fails_if_not_authenticated()
    {
        $this->json('POST', 'api/payment-methods')

        ->assertStatus(401);
    }

    public function test_it_requires_a_token()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/payment-methods')

        ->assertJsonValidationErrors([
            'token'
        ]);
    }

    public function test_it_successfully_add_a_card()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/payment-methods', [
            'token' => 'tok_visa'
        ]);

        $this->assertDatabaseHas('payment_methods', [
            'user_id' => $user->id,
            'card_type' => 'Visa',
            'last_four' => '4242',
        ]);
    }

    public function test_it_returns_a_created_card()
    {
        $user = factory(User::class)->create();

        $this->jsonAs($user, 'POST', 'api/payment-methods', [
            'token' => 'tok_visa'
        ])

        ->assertJsonFragment([
            'card_type' => 'Visa',
            'last_four' => '4242',
        ]);
    }

    public function test_it_creates_card_as_default()
    {
        $user = factory(User::class)->create();

        $response = $this->jsonAs($user, 'POST', 'api/payment-methods', [
            'token' => 'tok_visa'
        ]);

        $this->assertDatabaseHas('payment_methods', [
            'id' => json_decode($response->getContent())->data->id,
            'default' => 1,
        ]);
    }
}
