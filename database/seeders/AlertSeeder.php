<?php

namespace Database\Seeders;

use App\Models\Alert;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class AlertSeeder extends Seeder
{
    public function run(): void
    {
        // Alertes de tâches en retard (due_date passée et pas terminée)
        $tachesEnRetard = Task::where('due_date', '<', now())
            ->where('status', '!=', 'terminee')
            ->get();

        foreach ($tachesEnRetard as $task) {
            Alert::create([
                'project_id' => $task->project_id,
                'task_id' => $task->id,
                'type' => 'retard',
                'message' => 'La tâche "' . $task->title . '" est en retard.',
                'is_read' => false,
            ]);
        }

        // Alertes de tâches bloquées
        $tachesBloquees = Task::where('status', 'bloquee')->get();

        foreach ($tachesBloquees as $task) {
            Alert::create([
                'project_id' => $task->project_id,
                'task_id' => $task->id,
                'type' => 'bloquee',
                'message' => 'La tâche "' . $task->title . '" est bloquée.',
                'is_read' => false,
            ]);
        }

        // Alertes de projets à risque élevé
        $projetsRisque = Project::where('risk_level', 'eleve')->get();

        foreach ($projetsRisque as $project) {
            Alert::create([
                'project_id' => $project->id,
                'task_id' => null,
                'type' => 'risque_eleve',
                'message' => 'Le projet "' . $project->name . '" présente un risque élevé.',
                'is_read' => false,
            ]);
        }
    }
}