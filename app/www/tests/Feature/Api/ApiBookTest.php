<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiBookTest extends TestCase
{
    public function test_api_get_book_status()
    {
        $response = $this->get('/api/book/get');

        $response->assertStatus(200);
    }

    public function test_api_get_book_with_params_status()
    {
        $response = $this->get('/api/book/get?genre=1');

        $response->assertStatus(200);
    }

    public function test_api_get_book_data()
    {
        $response = $this->getJson('/api/book/get');
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function test_api_get_book_with_params_data()
    {
        $response = $this->getJson('/api/book/get?genre=1');
        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
}
