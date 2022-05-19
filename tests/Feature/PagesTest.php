<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_page_cannot_be_stored_without_permissions()
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('pages.store'))->assertStatus(403);
    }

    public function test_page_is_stored_to_book()
    {
        $this->actingAs($user = User::factory()->create());
        $user->givePermissionTo('edit pages');
        $book = Book::factory()->create();

        $payload = [
            'book_id' => $book->id,
            'page_number' => $this->faker->unique()->randomDigit(),
            'content' => $this->faker->paragraph(),
        ];

        $response = $this->post(route('pages.store', $payload));

        $page = Book::first()->pages()->first();
        $this->assertSame($page->page_number, $payload['page_number']);
        $this->assertSame($page->content, $payload['content']);

        $response->assertRedirect(route('books.show', $book));
    }
}
