<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Book::create([
        //     'title' => 'Sample Book 1',
        //     'author' => 'John Doe',
        //     'published_year' => 2022,
        // ]);

        // Book::create([
        //     'title' => 'Sample Book 2',
        //     'author' => 'Jane Smith',
        //     'published_year' => 2021,
        // ]);
        $faker=Faker::create();
        for($i=0;$i<100;$i++){
            $book=new Book();
            $book->title=$faker->word;
            $book->author=$faker->word;
            $book->published_year=(int)$faker->year;
            $book->save();
        }



        
    }
}
