<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:admin")->except(["index", "show"]);
    }

    public function index(Request $request)
    {
        // return response()->json(["host"=>$request->root(), "env"=>$request->header(), "ref"=>$_SERVER]);

        // $this->authorize('admin', Book::class);
        $books = Book::paginate(10);
        return response()->json($books);

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
