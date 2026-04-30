<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // Gets only the tasks belonging to the current user
        $tasks = auth()->user()->tasks()->latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        // Automatically links the new task to the logged-in user
        auth()->user()->tasks()->create([
            'title' => $request->title
        ]);

        return redirect()->back();
    }

    public function update($id)
    {
        // Toggles 'is_done' for a task belonging to the user
        $task = auth()->user()->tasks()->findOrFail($id);
        $task->is_done = !$task->is_done;
        $task->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        // Deletes a task only if it belongs to the user
        auth()->user()->tasks()->findOrFail($id)->delete();

        return redirect()->back();
    }
}
