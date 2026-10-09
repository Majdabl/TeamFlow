<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $chefs = User::where('role', 'chef_projet')->pluck('id')->toArray();
        $employes = User::where('role', 'employe')->pluck('id')->toArray();

        $projets = [
            ['name' => 'Refonte site e-commerce', 'status' => 'en_cours', 'risk_level' => 'moyen'],
            ['name' => 'Application mobile RH', 'status' => 'en_cours', 'risk_level' => 'eleve'],
            ['name' => 'Migration base de données', 'status' => 'planifie', 'risk_level' => 'faible'],
            ['name' => 'Dashboard analytique', 'status' => 'en_cours', 'risk_level' => 'moyen'],
            ['name' => 'Système de facturation', 'status' => 'termine', 'risk_level' => 'faible'],
            ['name' => 'Portail client', 'status' => 'en_cours', 'risk_level' => 'eleve'],
            ['name' => 'Automatisation reporting', 'status' => 'planifie', 'risk_level' => 'moyen'],
            ['name' => 'Sécurisation infrastructure', 'status' => 'suspendu', 'risk_level' => 'eleve'],
        ];

        foreach ($projets as $index => $data) {
            $project = Project::create([
                'name' => $data['name'],
                'description' => 'Projet de développement : ' . $data['name'],
                'status' => $data['status'],
                'risk_level' => $data['risk_level'],
                'chef_id' => $chefs[$index % count($chefs)],
                'start_date' => now()->subMonths(rand(1, 6)),
                'end_date' => now()->addMonths(rand(1, 4)),
            ]);

            // Assigner 2 à 4 employés aléatoires comme membres
            $membres = collect($employes)->random(rand(2, 4));
            $project->members()->attach($membres);
        }
    }
}