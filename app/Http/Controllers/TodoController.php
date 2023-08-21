<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();

        return response()->json($todos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task = $request->task;
        $newTodo = Todo::create(['task' => $task]);

        return response()->json($newTodo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task= $request->task;
        $task= $request->complete;

        $todo = Todo::findOrFail($id);

        $todo->task = $task;
        $todo->save();

        return response()->json('success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::findOrFail($id)->delete();

        return response()->json('success');
    }
}
