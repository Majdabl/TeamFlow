<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $titres = [
            'Analyse des besoins', 'Maquettage UI', 'Développement API',
            'Intégration frontend', 'Tests unitaires', 'Correction de bugs',
            'Rédaction documentation', 'Déploiement staging', 'Revue de code',
            'Optimisation performance',
        ];

        $statuts = ['a_faire', 'en_cours', 'bloquee', 'terminee'];
        $priorites = ['basse', 'moyenne', 'haute'];

        $projects = Project::with('members')->get();

        foreach ($projects as $project) {
            $nbTaches = rand(3, 5);

            for ($i = 0; $i < $nbTaches; $i++) {
                $membre = $project->members->isNotEmpty()
                    ? $project->members->random()->id
                    : null;

                Task::create([
                    'project_id' => $project->id,
                    'assigned_to' => $membre,
                    'title' => $titres[array_rand($titres)],
                    'description' => 'Tâche liée au projet ' . $project->name,
                    'status' => $statuts[array_rand($statuts)],
                    'priority' => $priorites[array_rand($priorites)],
                    'due_date' => now()->addDays(rand(-10, 30)),
                ]);
            }
        }
    }
}