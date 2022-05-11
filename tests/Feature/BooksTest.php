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

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_books_are_returned()
    {
        $this->actingAs(User::factory()->create());

        $books = Book::factory()->has(Page::factory(13))->count(3)->create();

        $this->get('/books')->assertInertia(
            fn(Assert $page) => $page
                ->component('Books')
                ->url('/books')
                ->has('books.data', $books->count())
                ->has('books.data.0.pages', $books[0]->pages()->count())
                ->has('books.per_page')
        );
    }
}
