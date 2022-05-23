<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        Storage::fake('s3');

        $this->actingAs($user = User::factory()->create());
        $user->givePermissionTo('edit pages');
        $book = Book::factory()->create();

        $payload = [
            'book_id' => $book->id,
            'content' => $this->faker->paragraph(),
            'image' => UploadedFile::fake()->image('photo1.jpg')
        ];

        $response = $this->post(route('pages.store'), $payload);

        $filePath = 'book/'.$book->slug.'/'.$payload['image']->hashName();
        Storage::disk('s3')->assertExists($filePath);

        $page = Book::find($book->id)->pages->first();
        $this->assertSame($page->image_path, Storage::url($filePath));
        $this->assertSame($page->content, $payload['content']);

        $response->assertRedirect(route('books.show', $book));
    }
}
