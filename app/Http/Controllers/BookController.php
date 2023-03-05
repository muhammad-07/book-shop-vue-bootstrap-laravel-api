<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:admin")->except(["index", "show", "search"]);
    }

    public function index(Request $request)
    {
         // $this->authorize('admin', Book::class);
        $term = 'lol';
        // $books = new Book();
        // $books = $books->where('books.title','LIKE','%'.$term.'%')->paginate(10);//->get();

        // dd($books);
        $books = Book::paginate(10);
        return response()->json($books);

    }
    public function search(Request $request)
    {
        $books = new Book();

        if ($request->filled('title')) {
            $books = $books->where('books.title','LIKE','%'.$request->input('title').'%');
        }
        if ($request->filled('published_from')) {
            $books = $books->whereDate('books.publishedAt','>=',$request->input('published_from'));
        }
        if ($request->filled('published_to')) {
            $books = $books->whereDate('books.publishedAt','<=',$request->input('published_to'));
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
    public function store(Request $request)
    {
        // TODO: ADD OTHER FIELDS

        $book = new Book([
            'isbn' => $request->input('isbn'),
            'title' => $request->input('title'),
            'author' => $request->input('author')
        ]);
        $book->save();
        return response()->json('Book created!');
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
