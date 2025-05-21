@extends('layouts.app', [
	'paceTop' => true,
	'appSidebarHide' => true,
	'appHeaderHide' => true,
	'appContentClass' => 'p-0'
])

@section('title', '403 Página de Error')

@section('content')
	<!-- BEGIN error -->
	<div class="error">
		<div class="error-code">404</div>
		<div class="error-content">
			<div class="error-message">Pagina no encontrada.</div>
			<div class="error-desc mb-4">
				Este recurso no existe en el servidor. <br />
				Pongase en contacto con su administrador.
			</div>
			<div>
				<a href="/" class="btn btn-success px-3">Regresar</a>
			</div>
		</div>
	</div>
	<!-- END error -->
@endsection
