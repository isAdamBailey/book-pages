<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class BooksTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_books_are_returned()
    {
        $this->actingAs(User::factory()->create());

        $books = Book::factory()->has(Page::factory(13))->count(3)->create();

        $this->get(route('books.index'))->assertInertia(
            fn(Assert $page) => $page
                ->component('Books')
                ->url('/books')
                ->has('books.data', $books->count())
                ->has('books.data.0', fn(Assert $page) => $page
                    ->where('pages_count', $books[0]->pages->count())
                    ->etc()
                )
                ->has('books.per_page')
        );
    }

    public function test_book_is_returned()
    {
        $this->actingAs(User::factory()->create());

        $book = Book::factory()->has(Page::factory(23))->create();

        $this->get(route('books.show', $book))->assertInertia(
            fn(Assert $page) => $page
                ->component('Book')
                ->url('/book/'.$book->slug)
        );
    }

    public function test_book_cannot_be_stored_without_permissions()
    {
        $this->actingAs(User::factory()->create());

        $this->post(route('books.store'))->assertStatus(403);
    }

    public function test_book_is_stored()
    {
        $this->actingAs($user = User::factory()->create());
        $user->givePermissionTo('edit pages');

        $payload = [
            'title' => $this->faker->sentence(3),
            'author' => $this->faker->name(),
            'excerpt' => $this->faker->paragraph(),
        ];

        $response = $this->post(route('books.store', $payload));

        $book = Book::first();
        $this->assertSame($book->title, $payload['title']);
        $this->assertSame($book->author, $payload['author']);
        $this->assertSame($book->excerpt, $payload['excerpt']);

        $response->assertRedirect(route('books.show', $book));
    }
}
