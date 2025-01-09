<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ApiUserTest extends TestCase
{
    use DatabaseTransactions;

    public function test_api_get_user()
    {
        $user = User::factory()->create();

        $responseLogin = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $responseLogin
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $responseContent = json_decode($responseLogin->getContent());

        $this->assertIsString($responseContent->token);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '.$responseContent->token,
        ])->postJson('/api/user');
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
}
