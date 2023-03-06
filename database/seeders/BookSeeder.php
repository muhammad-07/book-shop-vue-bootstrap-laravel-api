<?php

namespace Database\Seeders;

use App\Models\Book;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Concerns;


class BookSeeder extends Seeder
{
    use Concerns\InteractsWithIO;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        try {
            $client = new Client(['verify' => false]); // FALSE is for local_env If no ssl

            $Query = $client->get('https://fakerapi.it/api/v1/books?_quantity=100');
            $books_body = $Query->getBody();
            $books_data = json_decode($books_body, true);
        } catch (ClientException $e) {
            $this->info($e->getMessage());
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


            // INDEX TO ES
            // MOVED TO COMMAND INDEX:BOOKS

        } else {
            $this->info("No data received from fakerapi");
        }
    }
}
