<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') - Gestion de Projets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .sidebar { width: 250px; min-height: 100vh; background: #1e2a3a; position: fixed; top:0; left:0; padding-top: 1rem; transition: transform .3s; z-index: 1040; }
        .sidebar .brand { color:#fff; font-weight:600; font-size:1.2rem; padding: 0 1.2rem 1.5rem; display:block; }
        .sidebar a { color:#b6c2d1; padding:.65rem 1.2rem; display:flex; align-items:center; gap:.6rem; text-decoration:none; font-size:.92rem; }
        .sidebar a i { width:18px; text-align:center; }
        .sidebar a.active, .sidebar a:hover { background:#2c3e50; color:#fff; border-left:3px solid #4e73df; }
        .main-content { margin-left:250px; padding: 1.5rem 2rem; }
        .topbar { background:#fff; padding:.8rem 1.5rem; border-radius:.5rem; box-shadow:0 1px 3px rgba(0,0,0,.06); display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; }
        .stat-card { border:none; border-radius:.75rem; box-shadow:0 1px 3px rgba(0,0,0,.06); }
        .stat-icon { width:48px; height:48px; border-radius:.6rem; display:flex; align-items:center; justify-content:center; font-size:1.2rem; }
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left:0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="sidebar" id="sidebar">
        <span class="brand"><i class="fa-solid fa-diagram-project"></i> GestionProjets</span>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="#"><i class="fa-solid fa-users"></i> Utilisateurs</a>
            <a href="#"><i class="fa-solid fa-diagram-project"></i> Projets</a>
            <a href="#"><i class="fa-solid fa-list-check"></i> Tâches</a>
            <a href="#"><i class="fa-solid fa-chart-line"></i> Performance</a>
            <a href="#"><i class="fa-solid fa-triangle-exclamation"></i> Alertes</a>
            <a href="#"><i class="fa-solid fa-file-lines"></i> Rapports</a>
            <a href="#"><i class="fa-solid fa-gear"></i> Paramètres</a>
        @elseif(auth()->user()->role === 'chef_projet')
            <a href="{{ route('manager.dashboard') }}" class="{{ request()->routeIs('manager.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="#"><i class="fa-solid fa-diagram-project"></i> Mes projets</a>
            <a href="#"><i class="fa-solid fa-list-check"></i> Tâches</a>
            <a href="#"><i class="fa-solid fa-chart-line"></i> Performance</a>
            <a href="#"><i class="fa-solid fa-shield-halved"></i> Analyse des risques</a>
            <a href="#"><i class="fa-solid fa-triangle-exclamation"></i> Alertes</a>
            <a href="#"><i class="fa-solid fa-file-lines"></i> Rapports</a>
        @else
            <a href="{{ route('employee.dashboard') }}" class="{{ request()->routeIs('employee.dashboard') ? 'active' : '' }}"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="#"><i class="fa-solid fa-diagram-project"></i> Mes projets</a>
            <a href="#"><i class="fa-solid fa-list-check"></i> Mes tâches</a>
            <a href="#"><i class="fa-solid fa-chart-line"></i> Ma performance</a>
            <a href="#"><i class="fa-solid fa-triangle-exclamation"></i> Mes alertes</a>
        @endif
    </nav>

    <div class="main-content">
        <div class="topbar">
            <button class="btn btn-sm btn-light d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div></div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted small">{{ auth()->user()->name }} · <span class="badge bg-secondary">{{ auth()->user()->role }}</span></span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</button>
                </form>
            </div>
        </div>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>