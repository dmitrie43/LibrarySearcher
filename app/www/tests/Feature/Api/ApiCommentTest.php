<?php

namespace Tests\Feature\Api;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiCommentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_create_book_comment()
    {
        $user = User::factory()->create();

        $comment = [
            'theme' => 'Test theme',
            'text' => 'Test text',
            'item_id' => Book::query()->first()->id,
        ];

        $response = $this->actingAs($user)
            ->putJson('/api/comments/books/reviews', $comment);

        $response
            ->assertStatus(200);

        $this->assertDatabaseHas('comments', [
            'theme' => $comment['theme'],
            'text' => $comment['text'],
            'commentable_type' => 'books',
            'commentable_id' => $comment['item_id'],
            'is_recommended' => false,
            'is_approved' => false,
            'user_id' => $user['id'],
        ]);
    }

    public function test_create_book_comment_guest()
    {
        $comment = [
            'theme' => 'Test theme',
            'text' => 'Test text',
            'item_id' => Book::query()->first()->id,
        ];

        $response = $this->putJson('/api/comments/books/reviews', $comment);

        $response
            ->assertStatus(401);

        $this->assertDatabaseEmpty('comments');
    }
}
