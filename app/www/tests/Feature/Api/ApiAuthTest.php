<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    use DatabaseTransactions;

    public function test_api_auth_login()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
}
