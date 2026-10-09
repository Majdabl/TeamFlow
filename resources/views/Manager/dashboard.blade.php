@extends('layouts.app')
@section('title', 'Dashboard Chef de projet')

@section('content')
<h4 class="mb-4">Bonjour {{ auth()->user()->name }} 👋</h4>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card stat-card p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="fa-solid fa-diagram-project"></i></div>
            <div><div class="text-muted small">Mes projets</div><div class="fs-4 fw-bold">{{ $stats['projects'] }}</div></div>
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
            <div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="fa-solid fa-shield-halved"></i></div>
            <div><div class="text-muted small">Projets à risque élevé</div><div class="fs-4 fw-bold">{{ $stats['risky'] }}</div></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3 d-flex flex-row align-items-center gap-3">
            <div class="stat-icon bg-danger bg-opacity-10 text-danger"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div><div class="text-muted small">Alertes non lues</div><div class="fs-4 fw-bold">{{ $stats['alerts'] }}</div></div>
        </div>
    </div>
</div>

<div class="card stat-card p-3">
    <h6 class="mb-3">Mes tâches par statut</h6>
    <canvas id="tasksChart" height="90"></canvas>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('tasksChart'), {
    type: 'bar',
    data: { labels: {!! json_encode($tasksByStatus->keys()) !!}, datasets: [{ label: 'Tâches', data: {!! json_encode($tasksByStatus->values()) !!}, backgroundColor: '#4e73df' }] },
    options: { plugins: { legend: { display:false } } }
});
</script>
@endpush