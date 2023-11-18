<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

         <li class="nav-item">
            <a href="{{ url('/home') }}" class="nav-link">
            <i class="nav-icon fas fa-home orange" style="color: green;"></i>
                <p>
                    Inicio
                </p>
            </a>

        </li>
        <li class="nav-item">
            <a href="{{ url('/clientes') }}" class="nav-link">
            <i class="nav-icon fas fa-users" style="color: blue;"></i>
                <p>
                    Cliente
                </p>
            </a>

        </li>
        @if (session('nivel')=='A')
        <li class="nav-item">
            <a href="{{ url('/empleados') }}" class="nav-link">
            <i class="nav-icon fas fa-user" style="color: Orange;"></i>
                <p>
                    Empleado
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ url('/usuarios') }}" class="nav-link">
            <i class="nav-icon fas fa-key" style="color: yellow;"></i>
                <p>
                    Usuario
                </p>
            </a>
        </li>
        @endif
        <li class="nav-item">
            <a href="{{ url('/categorias') }}" class="nav-link">
            <i class="nav-icon fas fa-tags" style="color: Purple;"></i>
                <p>
                    Categoria
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/horarios') }}" class="nav-link">
            <i class="nav-icon fas fa-clock" style="color: pink;"></i>
                <p>
                    Horario
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/motos') }}" class="nav-link">
            <i class="nav-icon fas fa-motorcycle" style="color: Gold;"></i>
                <p>
                    Motos
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/citas') }}" class="nav-link">
            <i class="nav-icon fas fa-calendar" style="color: gray;"></i>
                <p>
                    Citas
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ url('/reporte') }}" class="nav-link">
            <i class="nav-icon fas fa-chart-bar" style="color: Cyan;"></i>
                <p>
                Reporte Categoria
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('logout') }}" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt" style="color: red;"></i>
                <p>
                    Salir
                </p>
            </a>
        </li>
    </ul>
</nav>
