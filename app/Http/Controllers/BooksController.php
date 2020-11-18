<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('pages.books.index', [
            'page' => 'books',
        ]);
    }

    public function index()
    {
        return [
            'books' => Book::with('tags')->where('user_id', Auth::user()->id)->get(),
        ];
    }

    public function new(Request $request)
    {
        $book = new Book;
        $book->title = $request->title;
        $book->category = $request->category ?? null;
        $book->is_read = $request->is_read ?? null;
        $book->rating = $request->rating ?? null;
        $book->user_id = Auth::user()->id;
        $book->save();

        if (!empty(trim($request->tags))) {
            $tags = explode(" ", $request->tags);
            foreach ($tags as $tag) {
                $book->tags()->attach($tag);
            }
        }

        return [
            'success' => true,
            'message' => 'new book has been added',
        ];
    }

    public function delete($id)
    {
        $book = Book::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        if ($book) {
            $book->delete();
            return [
                'success' => true,
                'message' => "Book with id $id has been deleted",
            ];
        }

        return [
            'success' => false,
            'message' => "Book with id $id is not found",
        ];
    }
}
