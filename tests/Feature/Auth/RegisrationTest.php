<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisrationTest extends TestCase
{
    
    public function test_it_requires_a_name()
    {
        $this->json('POST', 'api/auth/signup')
            ->assertJsonValidationErrors(['name']);
    }

    public function test_it_requires_an_email()
    {
        $this->json('POST', 'api/auth/signup')
            ->assertJsonValidationErrors(['email']);
    }

    public function test_it_requires_a_valid_email()
    {
        $this->json('POST', 'api/auth/signup', [
            'email' => 'now'
        ])
            ->assertJsonValidationErrors(['email']);
    }

    public function test_it_requires_a_unique_email()
    {
        $user = factory(User::class)->create();

        $this->json('POST', 'api/auth/signup', [
            'email' => $user->email
        ])
            ->assertJsonValidationErrors(['email']);
    }

    public function test_it_requires_a_password()
    {
        $this->json('POST', 'api/auth/signup')
            ->assertJsonValidationErrors(['password']);
    }

    public function test_it_registers_a_user()
    {
        $this->json('POST', 'api/auth/signup', [
            'name' => $name = 'Al Smith',
            'email' => $email = 'alsmith@gm.com',
            'password' => 'samsamdom'
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email
        ]);
            
    }

    public function test_it_returns_a_user_on_registration()
    {
        $this->json('POST', 'api/auth/signup', [
            'name' => $name = 'Al Smith',
            'email' => $email = 'alsmith@gm.com',
            'password' => 'samsamdom'
        ])

        ->assertJsonFragment([
            'email' => $email
        ]);
            
    }
}
