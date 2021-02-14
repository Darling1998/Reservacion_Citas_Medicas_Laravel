<span class="docs-normal">Gestionar Datos</span>
<ul class="navbar-nav">
<li class="nav-item">
    <a class="nav-link active" href="examples/dashboard.html">
    <i class="ni ni-tv-2 text-primary"></i>
    <span class="nav-link-text">Dashboard</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="examples/icons.html">
    <i class="ni ni-paper-diploma text-orange"></i>
    <span class="nav-link-text">Especialidades</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="examples/map.html">
    <i class="ni ni-badge text-primary"></i>
    <span class="nav-link-text">Medicos</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="examples/profile.html">
    <i class="ni ni-single-02 text-yellow"></i>
    <span class="nav-link-text">Pacientes</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="examples/tables.html">
    <i class="ni ni-bullet-list-67 text-default"></i>
    <span class="nav-link-text">Administrador</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('formLogout').
    submit();">
    <i class="ni ni-key-25"></i>
    <span class="nav-link-text">Cerrar sesión</span>
    </a>
    <form action="{{ route('logout')}}" method="POST" style="display:none;" id="formLogout">
        @csrf


    </form>
</li>
</ul>
<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading p-0 text-muted">
<span class="docs-normal">Reportes</span>
</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
<li class="nav-item">
    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html" target="_blank">
    <i class="ni ni-watch-time text-green"></i>
    <span class="nav-link-text">Frecuencia de Citas</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html" target="_blank">
    <i class="ni ni-collection text-danger"></i>
    <span class="nav-link-text">Médicos más solicitados</span>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html" target="_blank">
    <i class="ni ni-money-coins text-warning"></i>
    <span class="nav-link-text">Especialidades mas demandadas</span>
    </a>
</li>
</ul>