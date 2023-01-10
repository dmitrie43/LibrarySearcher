<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiGenreTest extends TestCase
{
    public function test_api_get_genre_status()
    {
        $response = $this->get('/api/genre/get');

        $response->assertStatus(200);
    }

    public function test_api_get_genre_with_params_status()
    {
        $response = $this->get('/api/book/get?id=1');

        $response->assertStatus(200);
    }

    public function test_api_get_genre_data()
    {
        $response = $this->getJson('/api/genre/get');
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function test_api_get_genre_with_params_data()
    {
        $response = $this->getJson('/api/genre/get?id=1');
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
}
