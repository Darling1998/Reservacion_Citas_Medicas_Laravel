<span class="docs-normal">
    @if(auth()->user()->role_id==1)
    Gestionar Datos
    @else
    Menu
    @endif()
</span>
<ul class="navbar-nav">
    @if(auth()->user()->role_id==1)
{{--     <li class="nav-item">
        <a class="nav-link active" href="/home">
        <i class="ni ni-tv-2 text-primary"></i>
        <span class="nav-link-text">Dashboard</span>
        </a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="/especialidades">
        <i class="ni ni-paper-diploma text-orange"></i>
        <span class="nav-link-text">Especialidades</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/medicos">
        <i class="ni ni-badge text-primary"></i>
        <span class="nav-link-text">Medicos</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/pacientes">
        <i class="ni ni-single-02 text-yellow"></i>
        <span class="nav-link-text">Pacientes</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/citas">
        <i class="ni ni-calendar-grid-58 text-orange"></i>
        <span class="nav-link-text">Todas las Citas</span>
        </a>
    </li>
{{--     <li class="nav-item">
        <a class="nav-link" href="examples/tables.html">
        <i class="ni ni-bullet-list-67 text-default"></i>
        <span class="nav-link-text">Administrador</span>
        </a>
    </li> --}}
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
    @elseif(auth()->user()->role_id==2)
    <li class="nav-item">
        <a class="nav-link" href="/horario">
        <i class="ni ni-time-alarm text-red"></i>
        <span class="nav-link-text">Gestionar Horario</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/citas">
        <i class="ni ni-calendar-grid-58 text-orange"></i>
        <span class="nav-link-text">Mis Citas</span>
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
    @endif
</ul>
@if(auth()->user()->role_id==1)
<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading p-0 text-muted">
<span class="docs-normal">Reportes</span>
</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
    <li class="nav-item">
        <a class="nav-link" href="{{ url ('/reportes/citas/lineas')}}" >
        <i class="ni ni-watch-time text-green"></i>
        <span class="nav-link-text">Frecuencia de Citas</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url ('/reportes/medicos/barras')}}">
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

@endif()