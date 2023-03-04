<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        try {
            $client = new Client(['verify'=>false]); // FALSE is for local_env If no ssl

            $Query = $client->get('https://fakerapi.it/api/v1/books?_quantity=10');
            $books_body = $Query->getBody();
            $books_data = json_decode($books_body, true);
        } catch (ClientException $e) {
            dd($e);
        }

        if ($books_data["data"]) {
            foreach ($books_data["data"] as $book) {
                $books[] = [
                    'title' => $book['title'],
                    'author' => $book['author'],
                    'isbn'  => $book['isbn'],
                    'genre' => $book['genre'],
                    'image' => $book['image'],
                    'publishedAt' => $book['published'],
                    'publisher'   => $book['publisher'],
                    'description' => $book['description'],
                ];
                // Book::create($books);
            }
            Book::insert($books);
        }
        else {
            print_r("No data found");
            \Log::debug("No data found");
        }
    }
}
