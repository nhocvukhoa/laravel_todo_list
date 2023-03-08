<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Resources\TodoCollection;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::get();

        return TodoCollection::collection($todos);
    }

    public function store(Request $request)
    {
        Todo::create($request->all());
        $todos = Todo::get();
        
        return TodoCollection::collection($todos);
    }

    public function delete(Request $request)
    {
        Todo::find($request->id)->delete();
        $todos = Todo::get();

        return TodoCollection::collection($todos);
    }

    public function deleteAll(Request $request)
    {
        $params = $request->params;
        Todo::whereIn('id', $params)->delete();
        $todos = Todo::get();

        return TodoCollection::collection($todos);
    }

    public function doneAll(Request $request)
    {
        $params = $request->params;
        $tasks= Todo::whereIn('id', $params)->get();

        foreach ($tasks as $task) {
            $task['completed'] = 1;
            $task->save();
        }

        $todos = Todo::get();

        return TodoCollection::collection($todos);
    }
}
