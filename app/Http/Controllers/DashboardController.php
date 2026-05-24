<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->role == 'manager') {

            $projects = Project::count();
            $tasks = Task::count();
            $completed = Task::where('status', 'completed')->count();

            return view('dashboard.manager', compact(
                'projects'
            ));
        }

        // $tasks = auth()->user()->tasks;

        // return view('dashboard.employee', compact('tasks'));
    }
}
