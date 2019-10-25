<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $files = File::all();

        return view('files', [
            'files' => $files,
        ]);
    }

    public function add(Request $request)
    {
        $path = $request->file->store('files');
        $comment = $request->comment;

        $file = new File;
        $file->path = $path;
        $file->comment = $comment;
        $file->save();

        return [
            'success' => true,
            'file path' => $path,
            'comment' => $comment,
        ];
    }
}
