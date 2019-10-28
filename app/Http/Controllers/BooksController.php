<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BooksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return [
            'books' => Book::where('user_id', Auth::user()->id)->get(),
        ];
    }

    public function add(Request $request)
    {
        $book = new Book;
        $book->title = $request->title;
        $book->category = $request->category ?? null;
        $book->is_read = $request->is_read ?? null;
        $book->rating = $request->rating ?? null;
        $book->user_id = Auth::user()->id;
        $book->save();

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