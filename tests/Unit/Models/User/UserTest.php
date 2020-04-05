<?php

namespace Tests\Unit\Models\User;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    
    public function test_hashes_the_password_when_creating()
    {
    	$user = factory(User::class)->create([
    		'password' => 'cats'
    	]);

        $this->assertNotEquals($user->password, 'cats');
    }
}
