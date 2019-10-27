<?php

namespace App\Http\Controllers;

use App\File;
use App\Task;
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
            'tasks' => Task::where('user_id', Auth::user()->id)->get(),
        ];
    }

    public function add(Request $request)
    {
        $task = new Task;
        $task->user_id = Auth::user()->id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->deadline = $request->deadline;
        $task->save();

        return [
            'success' => true,
            'comment' => 'New task has been added',
        ];
    }
}
