<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1 administrateur
        User::create([
            'name' => 'Amina Benali',
            'email' => 'admin@gestion.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2 chefs de projet
        User::create([
            'name' => 'Karim Meziane',
            'email' => 'karim.chef@gestion.com',
            'password' => Hash::make('password'),
            'role' => 'chef_projet',
        ]);

        User::create([
            'name' => 'Sofia Larbi',
            'email' => 'sofia.chef@gestion.com',
            'password' => Hash::make('password'),
            'role' => 'chef_projet',
        ]);

        // 6 employés
        $employes = [
            'Yacine Boudiaf',
            'Lina Cherif',
            'Rayan Haddad',
            'Nour Belkacem',
            'Adam Ferhat',
            'Imane Ouyahia',
        ];

        foreach ($employes as $index => $nom) {
            User::create([
                'name' => $nom,
                'email' => 'employe' . ($index + 1) . '@gestion.com',
                'password' => Hash::make('password'),
                'role' => 'employe',
            ]);
        }
    }
}