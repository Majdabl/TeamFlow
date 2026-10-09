<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'risk_level',
        'chef_id',
        'start_date',
        'end_date',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    // Le chef de projet (un utilisateur) qui dirige ce projet
    public function chef()
    {
        return $this->belongsTo(User::class, 'chef_id');
    }

    // Les membres (employés) assignés à ce projet
    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members');
    }

    // Les tâches de ce projet
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Les alertes liées à ce projet
    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
}