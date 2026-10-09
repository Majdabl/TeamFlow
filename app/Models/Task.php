<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'assigned_to',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }

    // Le projet auquel appartient cette tâche
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // L'employé assigné à cette tâche
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Les alertes liées à cette tâche
    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
}