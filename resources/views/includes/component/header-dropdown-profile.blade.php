<div class="dropdown-menu dropdown-menu-end me-1">
	<a href="/perfil" class="dropdown-item">Perfil</a>
	<div class="dropdown-divider"></div>
    @can('crear usuarios')
	<a href="/usuarios" class="dropdown-item">Usuarios</a>
    <div class="dropdown-divider"></div>
    @endcan
	<a href="/logout" class="dropdown-item">Salir</a>
</div>
