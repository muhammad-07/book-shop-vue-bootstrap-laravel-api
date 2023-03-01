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
        // Array ( [status] => OK [code] => 200 [total] => 10 [data] => Array ( [0] => Array ( [id] => 1 [title] => RETURNED FROM HIM. [author] => Gerardo Thiel [genre] => Expedita [description] => Alice. 'Then it wasn't very civil of you to sit down without being invited,' said the Dormouse: 'not in that case I can do without lobsters, you know. Please, Ma'am, is this New Zealand or. [isbn] => 9780897905848 [image] => http://placeimg.com/480/640/any [published] => 1982-07-22 [publisher] => Quaerat Omnis ) [1] => Arr
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
