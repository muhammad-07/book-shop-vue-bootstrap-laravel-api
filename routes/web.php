<?php

use App\Models\Book;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('{any}', function () {
    return view('layouts.app');
})->where('any', '.*');

Route::get('/', function () {
    // try {
    //     $client = new Client(['verify'=>false]); // FALSE is for local_env If no ssl

    //     $Query = $client->get('https://fakerapi.it/api/v1/books?_quantity=10');
    //     $books_body = $Query->getBody();
    //     $books_data = json_decode($books_body, true);
    // } catch (ClientException $e) {
    //     dd($e);
    // }

    // if ($books_data["data"]) {
    //     foreach ($books_data["data"] as $book) {
    //         $books = [
    //             'title' => $book['title'],
    //             'author' => $book['author'],
    //             'isbn'  => $book['isbn'],
    //             'genre' => $book['genre'],
    //             'image' => $book['image'],
    //             'publishedAt' => $book['published'],
    //             'publisher'   => $book['publisher'],
    //             'description' => $book['description'],
    //         ];
    //         Book::create($books);
    //     }

    //     // print_r($books); //die;


    //     // Book::create([
    //     //     'title' => "title",
    //     //     'author' => "title",
    //     //     'isbn'  => "title",
    //     //     'genre' => "title",
    //     //     'image' => "title",
    //     //     'publishedAt' => "1982-07-22",
    //     //     'publisher'   => "1982-07-22",
    //     //     'description' => "1982-07-22",
    //     // ]);
    // }
    // else {
    //     print_r("No data found");
    //     return "No data found";
    // }

    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
