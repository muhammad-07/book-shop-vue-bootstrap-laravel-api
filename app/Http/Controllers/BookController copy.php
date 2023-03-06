<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\ServerResponseException;

class BookController extends Controller
{
    protected $index, $client;
    public function __construct()
    {
        $this->index = "index";
        $this->middleware("can:admin")->except(["index", "show", "search", "es_connect", "es_index", "es_search", "es_store", "es_index_all"]);
    }

    public function index(Request $request)
    {

        $books = Book::paginate(10);
        return response()->json($books);
    }
    public function es_connect()
    {
        // TODO: Chech If not connected
        return $this->client = ClientBuilder::create()
            ->setElasticCloudId(env('ES_CLOUD_ID'))
            ->setApiKey(env('ES_API_KEY'))
            ->build();

        // $response = $this->client->info();

        // echo $response['version']['number'];
        // echo $response->getStatusCode(); // 200
        // echo (string) $response->getBody(); // Response body in JSON
        // var_dump($response->asArray());
    }

    public function es_index_all()
    {
        $this->es_connect();
        $posts = Book::all(); //limit(2)->get();
        $indexed = [];
        foreach ($posts as $post) {
            $params = [
                'id' => $post->id,
                'index' => 'index',
                'body' => [
                    'title' => $post->title,
                    'author' => $post->author,
                    'isbn'  => $post->isbn,
                    'genre' => $post->genre,
                    'publishedAt' => $post->publishedAt,
                    'publisher'   => $post->publisher,
                    // 'description' => $post->description,
                ]
            ];
            $indexed[] = $post->id;
            try {
                $response = $this->client->index($params);
            } catch (ClientResponseException $e) {
                return ($e->getMessage());
            } catch (ServerResponseException $e) {
                return ($e->getMessage());
            } catch (\Exception $e) {
                return ($e->getMessage());
            }
        }

        return response()->json($indexed);
    }

    public function es_index($post)
    {
        $params = [
            'id' => $post->id,
            'index' => $this->index,
            'body' => [
                'title' => $post->title,
                'author' => $post->author,
                'isbn'  => $post->isbn,
                'genre' => $post->genre,
                'publishedAt' => $post->publishedAt,
                'publisher'   => $post->publisher,
                // 'description' => $post->description,
            ]
        ];

        try {
            $response = $this->client->index($params);
        } catch (ClientResponseException $e) {
            return ($e->getMessage());
        } catch (ServerResponseException $e) {
            return ($e->getMessage());
        } catch (\Exception $e) {
            return ($e->getMessage());
        }

        return ($response->asArray());
    }
    public function es_search($post)
    {
        $params = [
            'index' => $this->index,
            "size"=> 20,
            "from"=>20
            // 'body'  => [
            //     // "sort" =>  [
            //     //     "_id" => "asc",
            //     // ],
            //     'query' => [
            //         // 'match' => [
            //         //     // '_id' => 136
            //         //     'title' => 'was'
            //         // ],

            //         'bool' => [
            //             'must' => [
            //                 [
            //                     'match' => [
            //                         'title' => 'was',

            //                     ],
            //                     // 'match' => [
            //                     //     'genre' => 'Sit',
            //                     // ],
            //                 ]
            //             ],
            //             'filter' => [
            //                 // [
            //                 //     'term' => [
            //                 //         'genre' => 'Sit',
            //                 //     ],
            //                 // ],
            //                 [
            //                     'range' => [
            //                         'publishedAt' => [
            //                             'gte' => '1994-12-07',
            //                             "lte" => '2016-06-13'
            //                         ],
            //                     ],
            //                 ],
            //             ],
            //         ],

            //     ]
            // ]
        ];
        $response = $this->client->search($params);
        return $response->asArray();
        // printf("Total docs: %d\n", $response['hits']['total']['value']);
        // printf("Max score : %.4f\n", $response['hits']['max_score']);
        // printf("Took      : %d ms\n", $response['took']);

        // print_r($response['hits']['hits']); // documents
    }
    public function es_delete($post)
    {
        try {
            $response = $this->client->delete([
                'index' => $this->index,
                'id' => $post->id
            ]);
        } catch (ClientResponseException $e) {
            if ($e->getCode() === 404) {
                return ['record not found'];
            }
        }
        return $response->asArray();
        // if ($response['acknowledge'] === 1) {
        //     return ['record deleted'];
        // }
    }
    public function search(Request $request)
    {
        $books = new Book();

        if ($request->filled('title')) {
            $books = $books->where('books.title', 'LIKE', '%' . $request->input('title') . '%');
        }
        if ($request->filled('published_from')) {
            $books = $books->whereDate('books.publishedAt', '>=', $request->input('published_from'));
        }
        if ($request->filled('published_to')) {
            $books = $books->whereDate('books.publishedAt', '<=', $request->input('published_to'));
        }
        $books = $books->paginate(10);
        return response()->json($books);
        // $book = new Book([
        //     'isbn' => $request->input('isbn'),
        //     'title' => $request->input('title'),
        //     'author' => $request->input('author')
        // ]);
        // $book->save();
        // return response()->json('Book created!');
    }
    public function es_store(Request $request)
    {
        // TODO: ADD OTHER FIELDS

        $book = new Book([
            'isbn' => time(),
            'title' => 'abc',
            'author' => 'abc',
        ]);
        $book->save();
        $this->es_connect();

        // $es_response = $this->es_index($book);
        $es_response1 = $this->es_search($book = 1);
        // return $es_response2 = $this->es_delete($book=1);
        return response()->json([
            // 'index' => $es_response,
            'src' => $es_response1,
            //     'del'=>$es_response2
        ]);
    }
    public function store(Request $request)
    {
        // TODO: ADD OTHER FIELDS

        $book = new Book([
            'isbn' => $request->input('isbn'),
            'title' => $request->input('title'),
            'author' => $request->input('author'),

            // 'genre' => $request->input('genre'),
            // 'image' => $request->input('image'),
            // 'publishedAt' => $request->input('published'),
            // 'publisher'   => $request->input('publisher'),
            // 'description' => $request->input('description'),
        ]);
        $book->save();
        // $client = $this->es_connect();
        // $es_response = $this->es_index($client, $book);
        // $es_response1 = $this->es_search($client, $book);
        // $es_response2 = $this->es_delete($client, $book);
        return response()->json('Book has been added');
    }
    public function show($id)
    {
        $book = Book::find($id);
        return response()->json($book);
    }

    public function update($id, Request $request)
    {
        $book = Book::find($id);
        $book->update($request->all());
        return response()->json('Book updated!');
    }
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return response()->json('Book deleted!');
    }
}
