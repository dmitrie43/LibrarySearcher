<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiBookTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_api_get_books()
    {
        $response = $this->getJson('/api/books');
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }

    public function test_api_get_books_with_params()
    {
        $response = $this->getJson('/api/books?genre=1');
        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }
}
