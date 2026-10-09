@extends('layouts.app')
@section('title', 'Mon Dashboard')

@section('content')
<h4 class="mb-4">Bonjour {{ auth()->user()->name }} 👋</h4>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card stat-card p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="fa-solid fa-list-check"></i></div>
            <div><div class="text-muted small">Mes tâches</div><div class="fs-4 fw-bold">{{ $stats['tasks'] }}</div></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="fa-solid fa-circle-check"></i></div>
            <div><div class="text-muted small">Terminées</div><div class="fs-4 fw-bold">{{ $stats['done'] }}</div></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon bg-info bg-opacity-10 text-info"><i class="fa-solid fa-spinner"></i></div>
            <div><div class="text-muted small">En cours</div><div class="fs-4 fw-bold">{{ $stats['ongoing'] }}</div></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon bg-secondary bg-opacity-10 text-secondary"><i class="fa-solid fa-diagram-project"></i></div>
            <div><div class="text-muted small">Mes projets</div><div class="fs-4 fw-bold">{{ $stats['projects'] }}</div></div>
        </div>
    </div>
</div>

<div class="card stat-card p-3">
    <h6 class="mb-3">Mes tâches récentes</h6>
    <table class="table table-sm">
        <thead><tr><th>Titre</th><th>Statut</th><th>Priorité</th><th>Échéance</th></tr></thead>
        <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td><span class="badge bg-light text-dark">{{ $task->status }}</span></td>
                    <td>{{ $task->priority }}</td>
                    <td>{{ $task->due_date?->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-muted text-center">Aucune tâche assignée</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection