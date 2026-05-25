<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('employee', 'project')->latest()->paginate(10);

        return view('manager.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        $employees = User::where('role', 'employee')->get();

        return view('manager.tasks.create', compact(
            'projects',
            'employees'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'project_id' => 'required',
            'assigned_to' => 'required',
            'deadline' => 'required'
        ]);

        Task::create($request->all());

        return redirect()->route('manager.tasks.index')->with('success', 'Task assigned successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $projects = Project::all();
        $employees = User::where('role', 'employee')->get();

        return view('manager.tasks.edit', compact(
            'task',
            'projects',
            'employees'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task->update($request->all());

        return redirect()->route('manager.tasks.index')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task->delete();

        return back()->with('success', 'Task deleted successfully');
    }
}
