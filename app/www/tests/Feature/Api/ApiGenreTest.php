<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiGenreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_api_get_genres()
    {
        $response = $this->getJson('/api/genres');
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }

    public function test_api_get_genres_with_params()
    {
        $response = $this->getJson('/api/genres?id=1');
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }
}
