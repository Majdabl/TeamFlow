<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $stats = [
            'projects' => Project::count(),
            'tasks' => Task::count(),
            'users' => User::count(),
            'alerts' => Alert::where('is_read', false)->count(),
        ];

        $projectsByStatus = Project::selectRaw('status, COUNT(*) as total')->groupBy('status')->pluck('total', 'status');
        $tasksByStatus = Task::selectRaw('status, COUNT(*) as total')->groupBy('status')->pluck('total', 'status');

        return view('admin.dashboard', compact('stats', 'projectsByStatus', 'tasksByStatus'));
    }

    public function manager()
    {
        $user = Auth::user();
        $projectIds = Project::where('chef_id', $user->id)->pluck('id');

        $stats = [
            'projects' => $projectIds->count(),
            'tasks' => Task::whereIn('project_id', $projectIds)->count(),
            'risky' => Project::where('chef_id', $user->id)->where('risk_level', 'eleve')->count(),
            'alerts' => Alert::whereIn('project_id', $projectIds)->where('is_read', false)->count(),
        ];

        $tasksByStatus = Task::whereIn('project_id', $projectIds)
            ->selectRaw('status, COUNT(*) as total')->groupBy('status')->pluck('total', 'status');

        return view('manager.dashboard', compact('stats', 'tasksByStatus'));
    }

    public function employee()
    {
        $user = Auth::user();

        $stats = [
            'tasks' => Task::where('assigned_to', $user->id)->count(),
            'done' => Task::where('assigned_to', $user->id)->where('status', 'terminee')->count(),
            'ongoing' => Task::where('assigned_to', $user->id)->where('status', 'en_cours')->count(),
            'projects' => $user->projects()->count(),
        ];

        $tasks = Task::where('assigned_to', $user->id)->latest()->take(5)->get();

        return view('employee.dashboard', compact('stats', 'tasks'));
    }
}