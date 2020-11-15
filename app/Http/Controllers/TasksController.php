<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('pages.tasks.index', [
            'page' => 'tasks',
        ]);
    }


    public function index()
    {
        return [
            'tasks' => Task::with('tags')->where('user_id', Auth::user()->id)->get(),
        ];
    }

    public function new(Request $request)
    {
        $task = new Task;
        $task->user_id = Auth::user()->id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->deadline = $request->deadline;
        $task->save();

        if (!empty(trim($request->tags))) {
            $tags = explode(" ", $request->tags);
            foreach ($tags as $tag) {
                $task->tags()->attach($tag);
            }
        }

        return [
            'success' => true,
            'comment' => 'New task has been added',
        ];
    }

    public function delete($id)
    {
        $task = Task::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        if ($task) {
            $task->delete();
            return [
                'success' => true,
                'message' => "Task with id $id has been deleted",
            ];
        }

        return [
            'success' => false,
            'message' => "Task with id $id is not found",
        ];
    }
}
