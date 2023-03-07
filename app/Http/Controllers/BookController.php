<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\ServerResponseException;

class BookController extends Controller
{
    protected $index, $client, $page_size;
    public function __construct()
    {
        $this->index = "index";
        $this->es_connect();
        $this->page_size = 10;
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
    }

    public function es_index($post) //ADD TO Elastic Search
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
            return $response = $this->client->index($params);
        } catch (ClientResponseException $e) {
            return ($e->getMessage());
        } catch (ServerResponseException $e) {
            return ($e->getMessage());
        } catch (\Exception $e) {
            return ($e->getMessage());
        }

        // return ($response->asArray());
    }
    public function es_search(Request $request)
    {
        $must_match = [];
        $has_search = false;
        $body = [];

        if ($request->filled('title')) {
            $has_search = true;
            $must_match[] = ['match' => ['title' => $request->input('title')]];
        }
        if ($request->filled('genre')) {
            $has_search = true;
            $must_match[] = ['match' => ['genre' => $request->input('genre')]];
        }
        if ($request->filled('author')) {
            $has_search = true;
            $must_match[] = ['match' => ['author' => $request->input('author')]];
        }
        if ($request->filled('published_from')) {
            $has_search = true;
            $body['query']["bool"]["filter"]['range']['publishedAt']['gte'] = $request->input('published_from'); //date('Y-m-d', strtotime($request->input('published_to')));
        }
        if ($request->filled('published_to')) {
            $has_search = true;
            $body['query']["bool"]["filter"]['range']['publishedAt']['lte'] = $request->input('published_to');
        }


        if ($has_search === true)
            $body['query']["bool"]["must"] = $must_match;


        $params = [
            'index' => $this->index,
            "size"  => $this->page_size,
            "from"  => ($this->page_size * (int)$request->input('page')),
            'body'  => $has_search === true ? $body : []

        ];
        return $this->client->search($params);
    }
    public function es_update($post)
    {
        $params = [
            'index'=> $this->index,
            'id'   => $post->id,
            'body' => [
                'doc' => [
                    'title' => $post->title,
                    'author' => $post->author,
                    'isbn'  => $post->isbn,
                    'genre' => $post->genre,
                    'publishedAt' => $post->publishedAt,
                    'publisher'   => $post->publisher,
                ]
            ]
        ];
        try {
            return $response = $this->client->update($params);
        } catch (ClientResponseException $e) {
            return ($e->getMessage());
        } catch (ServerResponseException $e) {
            return ($e->getMessage());
        } catch (\Exception $e) {
            return ($e->getMessage());
        }
    }
    public function es_delete($id)
    {
        try {
            return $response = $this->client->delete([
                'index' => $this->index,
                'id' => $id
            ]);
        } catch (ClientResponseException $e) {
            if ($e->getCode() === 404) {
                return ['record not found'];
            }
        }
    }
    public function search(Request $request)
    {
        return $this->es_search($request);
    }

    public function store(Request $request)
    {
        $book = new Book([
            'isbn' => $request->input('isbn'),
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'genre' => $request->input('genre'),
            'publishedAt' => $request->input('published'),
            'publisher'   => $request->input('publisher'),
            'description' => $request->input('description')
        ]);
        if ($book->save() && $this->client)
            return $this->es_index($book);

        return response()->json('Book could not be added');
    }
    public function show($id)
    {
        // NOT BOTHERING Elastic just for one record
        $book = Book::find($id);
        return response()->json($book);
    }

    public function update($id, Request $request)
    {
        $book = Book::find($id);
        $book->update($request->all());

        if($this->client != null)
            $this->es_update((object)$request->all());
        return response()->json('Book updated!');
    }
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        if($this->client)
            $this->es_delete($id);
        return response()->json('Book deleted!');
    }
    public function es_index_all()
    {

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
}
