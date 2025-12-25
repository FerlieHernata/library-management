<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::insert([
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'category' => 'Programming',
                'year' => 2008,
                'stock' => 5
            ],
            [
                'title' => 'Laravel Up & Running',
                'author' => 'Matt Stauffer',
                'category' => 'Web Development',
                'year' => 2021,
                'stock' => 3
            ],
            [
                'title' => 'Design Patterns',
                'author' => 'Erich Gamma',
                'category' => 'Software Engineering',
                'year' => 1994,
                'stock' => 0
            ],
        ]);
    }
}
