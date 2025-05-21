@extends('layouts.app', [
	'paceTop' => true,
	'appSidebarHide' => true,
	'appHeaderHide' => true,
	'appContentClass' => 'p-0'
])

@section('title', '503 Servicio No Disponible')

@section('content')
	<!-- BEGIN error -->
	<div class="error">
		<div class="error-code">503</div>
		<div class="error-content">
			<div class="error-message">Servicio No Disponible.</div>
			<div class="error-desc mb-4">
				Plataforma Cerrada. <br />
				Pongase en contacto con SDUOPOT.
			</div>
			<div>
				<a href="/" class="btn btn-success px-3">Regresar</a>
			</div>
		</div>
	</div>
	<!-- END error -->
@endsection
