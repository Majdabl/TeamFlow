@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<h4 class="mb-4">Bonjour {{ auth()->user()->name }} 👋</h4>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card stat-card p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="fa-solid fa-diagram-project"></i></div>
            <div><div class="text-muted small">Projets</div><div class="fs-4 fw-bold">{{ $stats['projects'] }}</div></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="fa-solid fa-list-check"></i></div>
            <div><div class="text-muted small">Tâches</div><div class="fs-4 fw-bold">{{ $stats['tasks'] }}</div></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon bg-info bg-opacity-10 text-info"><i class="fa-solid fa-users"></i></div>
            <div><div class="text-muted small">Utilisateurs</div><div class="fs-4 fw-bold">{{ $stats['users'] }}</div></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon bg-danger bg-opacity-10 text-danger"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div><div class="text-muted small">Alertes non lues</div><div class="fs-4 fw-bold">{{ $stats['alerts'] }}</div></div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card stat-card p-3"><h6 class="mb-3">Projets par statut</h6><canvas id="projectsChart" height="200"></canvas></div>
    </div>
    <div class="col-md-6">
        <div class="card stat-card p-3"><h6 class="mb-3">Tâches par statut</h6><canvas id="tasksChart" height="200"></canvas></div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('projectsChart'), {
    type: 'doughnut',
    data: { labels: {!! json_encode($projectsByStatus->keys()) !!}, datasets: [{ data: {!! json_encode($projectsByStatus->values()) !!}, backgroundColor: ['#4e73df','#1cc88a','#f6c23e','#e74a3b'] }] }
});
new Chart(document.getElementById('tasksChart'), {
    type: 'bar',
    data: { labels: {!! json_encode($tasksByStatus->keys()) !!}, datasets: [{ label: 'Tâches', data: {!! json_encode($tasksByStatus->values()) !!}, backgroundColor: '#4e73df' }] },
    options: { plugins: { legend: { display:false } } }
});
</script>
@endpush