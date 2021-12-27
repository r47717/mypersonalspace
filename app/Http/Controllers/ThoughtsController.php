<?php

namespace App\Http\Controllers;

use App\Models\Thought;
use App\Services\ThoughtsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThoughtsController extends BaseController
{
    /**
     * @var ThoughtsService
     */
    private $thoughtsService;

    /**
     * ThoughtsController constructor.
     */
    public function __construct(ThoughtsService $thoughtsService)
    {
        parent::__construct();
        $this->middleware('auth');
        $this->thoughtsService = $thoughtsService;
    }

    public function show()
    {
        return view('pages.thoughts.index', [
            'page' => 'thoughts',
        ]);
    }

    public function index()
    {
        return [
            'thoughts' => Thought::with('tags')->where('user_id', Auth::user()->id)->get(),
        ];
    }

    public function add(Request $request)
    {
        $thought = $this->thoughtsService->newThought($request->text);

        if (!empty(trim($request->tags))) {
            $tags = explode(" ", $request->tags);
            foreach ($tags as $tag) {
                $thought->tags()->attach($tag);
            }
        }

        return [
            'success' => true,
            'message' => 'new thought has been added',
        ];
    }

    public function delete($id)
    {
        $thought = Thought::where(['user_id' => Auth::user()->id, 'id' => $id])->first();
        if ($thought) {
            $thought->delete();
            return [
                'success' => true,
                'message' => "Thought with id $id has been deleted",
            ];
        }

        return [
            'success' => false,
            'message' => "Thought with id $id is not found",
        ];
    }
}
