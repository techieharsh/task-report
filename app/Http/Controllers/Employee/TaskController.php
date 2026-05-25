<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks;
        return view('employee.tasks.index', compact('tasks'));
    }

    public function show(Task $task)
    {
        return view('employee.tasks.show', compact('task'));
    }

    public function updateStatus(Request $request, Task $task)
    {
        $task->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status updated successfully');
    }
}
