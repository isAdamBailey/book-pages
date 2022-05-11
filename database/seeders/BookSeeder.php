<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::factory()
            ->has(Page::factory()->count(13))
            ->create();
    }
}
