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
}
