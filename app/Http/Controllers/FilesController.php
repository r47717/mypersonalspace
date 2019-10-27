<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return [
            'files' => File::where('user_id', Auth::user()->id)->get(),
        ];
    }

    public function add(Request $request)
    {
        $path = $request->file->store('files');
        $comment = $request->comment;

        $file = new File;
        $file->path = $path;
        $file->comment = $comment;
        $file->user_id = Auth::user()->id;
        $file->save();

        return [
            'success' => true,
            'file path' => $path,
            'comment' => $comment,
        ];
    }
}
