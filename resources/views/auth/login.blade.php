@extends('layouts.app', [
	'paceTop' => true,
	'appSidebarHide' => true,
	'appHeaderHide' => true,
	'appContentClass' => 'p-0'
])

@section('title', 'Ingreso')

@push('css')
<style>

    .btn-sduopot{
        background-color: #ab0033;
        color: white;
    }

    .btn-sduopot:hover {
    background-color: #54565a;
    color: white;
    }

</style>
@endpush

@section('content')
	<!-- BEGIN login -->
	<div class="login login-with-news-feed">
		<!-- BEGIN news-feed -->
		<div class="news-feed">
			<div class="news-image" style="background-image: url(/assets/img/login-bg/sayco.jpg)"></div>
			<div class="news-caption">
					<h4 class="caption-title"><b>{{ config('app.name') }}</b> Plataforma Web</h4>
					<p>
						Secretaría de Desarrollo Urbano, Obras Públicas y Ordenamiento Territorial
					</p>
			</div>
		</div>
		<!-- END news-feed -->

		<!-- BEGIN login-container -->
		<div class="login-container">
			<!-- BEGIN login-header -->
			<div class="login-header mb-30px">
				<div class="brand">
					<div class="d-flex align-items-center">
						<span class="logo"></span>
						<b>Acceso</b>
					</div>
					<small>Ingrese las credenciales que le fueron enviadas.</small>
				</div>
				<div class="icon">
					<i class="fa fa-sign-in-alt"></i>
				</div>
			</div>
			<!-- END login-header -->

			<!-- BEGIN login-content -->
			<div class="login-content">

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <ul class="text-danger">
                    @foreach ($errors->all() as $error)
                        <li> <b>{{ $error }}</b></li>
                    @endforeach
                </ul>

                <form method="POST" action="{{ route('login.custom') }}" class="fs-13px" autocomplete="off">
                    @csrf
					<div class="form-floating mb-15px">
						<input type="text" class="form-control h-45px fs-13px" value="{{ old('rfc') }}" placeholder="RFC" id="rfc" name="rfc" />
						<label for="rfc" class="d-flex align-items-center fs-13px text-gray-600">RFC</label>
					</div>
					<div class="form-floating mb-15px">
						<input type="password" class="form-control h-45px fs-13px" placeholder="Contraseña" id="password" name="password" />
						<label for="password" class="d-flex align-items-center fs-13px text-gray-600">Contraseña</label>
					</div>
					<!-- <div class="form-check mb-30px">
						<input class="form-check-input" type="checkbox" value="1" id="rememberMe" />
						<label class="form-check-label" for="rememberMe">
							Recuerdame
						</label>
					</div> -->
					<div class="mb-15px">
						<button type="submit" class="btn btn-sduopot d-block h-45px w-100 btn-lg fs-14px">Ingresar</button>
					</div>
					<div class="mb-40px pb-40px text-dark">
						No tiene credenciales de acceso ? <br />
                        Registre su empresa <a href="https://puc.guerrero.gob.mx/registro/" class="text-primary">aquí</a> para obternerlas.
					</div>
					<hr class="bg-gray-600 opacity-2" />
					<div class="text-gray-600 text-center text-gray-500-darker mb-0">
						&copy; Derechos Reservados © 2021 - 2027 Secretaría de Desarrollo Urbano, Obras Públicas y Ordenamiento Territorial
					</div>
				</form>
			</div>
			<!-- END login-content -->
		</div>
		<!-- END login-container -->
	</div>
	<!-- END login -->
@endsection
