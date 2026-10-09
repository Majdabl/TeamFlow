<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Un utilisateur (chef de projet) peut diriger plusieurs projets
    public function projectsLed()
    {
        return $this->hasMany(Project::class, 'chef_id');
    }

    // Un utilisateur peut être membre de plusieurs projets
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_members');
    }

    // Un utilisateur peut avoir plusieurs tâches assignées
    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isChefProjet(): bool
    {
        return $this->role === 'chef_projet';
    }

    public function isEmploye(): bool
    {
        return $this->role === 'employe';
    }
}