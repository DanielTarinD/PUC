@extends('layouts.default', [
	'paceTop' => true,
	'appSidebarHide' => true,
	'appHeaderHide' => true,
	'appContentClass' => 'p-0'
])

@section('title', 'Pre-Registro')

@push('css')
<style>

    .login.login-with-news-feed .login-container, .login.login-with-news-feed .register-container, .register.register-with-news-feed .login-container, .register.register-with-news-feed .register-container {

        width: 600px;
    }


    .login.login-with-news-feed .news-feed, .register.register-with-news-feed .news-feed {

        right: 600px;
    }


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
	<!-- BEGIN register -->
	<div class="register register-with-news-feed">
		<!-- BEGIN news-feed -->
		<div class="news-feed">
            <div class="news-image" style="background-image: url(/assets/img/login-bg/sayco.jpg)"></div>
			<div class="news-caption">
                <h4 class="caption-title"><b>{{ config('app.name') }}</b> Plataforma Web</h4>
                    <p>
                        Bienvenido al nuevo sistema del Padrón Único de Contratistas
                        Para tener acceso al sistema y así  obtener su constancia debe :
                    </p>

                    <p>
                        1.- Solicita una cuenta ingresando la siguiente información :<br />

                        <ul>
                            <li> de la empresa Moral o Persona Física con actividad empresarial.</li>
                            <li> Nombre del Representante Legal.</li>
                            <li> RFC (Sin caracteres especiales).</li>
                            <li> Teléfono.</li>
                            <li> Correo Electrónico.</li>
                        </ul>
                        2.- Recibirás un correo electrónico de confirmación del preregistro.<br />

                        3.- Cuando tu información haya sido comprobada recibirás un correo con los accesos al sistema.
                    </p>

                    <p><b>IMPORTANTE: Revisa tu bandeja de correos no deseados y marca el remitente como seguro, si no lo haces no podrás recibir el correo de acceso.</b></p>

                    <p>No se deje engañar, este proceso es completamente gratuito .</p>

                    <p>Para cualquier duda o aclaración comunicarse al número :</p>

                    <p>747 471 9900 ext . 9676</p>

                </p>
			</div>
		</div>
		<!-- END news-feed -->

		<!-- BEGIN register-container -->
		<div class="register-container">
			<!-- BEGIN register-header -->
			<div class="register-header mb-25px h1">
				<div class="mb-1">Pre-Registro</div>
				<small class="d-block fs-15px lh-16">Inicia tu proceso para el registro en el Padrón Único de Contratistas</small>
			</div>
			<!-- END register-header -->

			<!-- BEGIN register-content -->
			<div class="register-content">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

				<form action="{{ route('registro.store') }}" method="POST" class="fs-13px" autocomplete="off">

                    @csrf

					<div class="mb-3">
						<label class="mb-2">Nombre de la Empresa <span class="text-danger">*</span></label>
						<input type="text" class="form-control fs-13px" placeholder="Nombre de la Empresa" id="nombre_empresa" value="{{ old('nombre_empresa') }}" name="nombre_empresa"/>
					</div>


					<div class="mb-3">
						<label class="mb-2">Nombre del Responsable <span class="text-danger">*</span></label>
						<input type="text" class="form-control fs-13px" placeholder="Nombre del Responsable" id="nombre_responsable" value="{{ old('nombre_responsable') }}" name="nombre_responsable" />
					</div>

                    <div class="mb-3">
						<label class="mb-2">RFC de la Empresa o Persona Física (Sin caracteres especiales) <span class="text-danger">*</span></label>
						<input type="text" class="form-control fs-13px" placeholder="RFC" id="rfc_empresa" name="rfc_empresa" value="{{ old('rfc_empresa') }}" />
					</div>


                    <div class="mb-3">
						<label class="mb-2">Teléfono de Contacto <span class="text-danger">*</span></label>
						<input type="text" class="form-control fs-13px" placeholder="Teléfono de Contacto" id="telefono_contacto"  name="telefono_contacto" value="{{ old('telefono_contacto') }}" />
					</div>

                    <div class="mb-3">
						<label class="mb-2">Correo Electrónico <span class="text-danger">*</span></label>
						<input type="text" class="form-control fs-13px" placeholder="Correo Electrónico" id="correo_contacto"   name="correo_contacto" value="{{ old('correo_contacto') }}" />
					</div>



                    <div class="form-check mb-4">
						<input class="form-check-input" type="checkbox" id="agreementCheckbox" name="agreementCheckbox" />
						<label class="form-check-label" for="agreementCheckbox">
							Confirmo haber leído y aceptar el <a href="{{ asset('assets/AP.pdf') }}" target="_blank">Aviso de Privacidad</a>.
						</label>
					</div>
					<div class="mb-4">
						<button type="submit" class="btn btn-sduopot d-block w-100 btn-lg h-45px fs-13px">Enviar</button>
					</div>

					<hr class="bg-gray-600 opacity-2" />
					<p class="text-center text-gray-600">
						&copy; Derechos Reservados 2021 - 2027 Secretaría de Desarrollo Urbano, Obras Públicas y Ordenamiento Territorial
					</p>
				</form>
			</div>
			<!-- END register-content -->
		</div>
		<!-- END register-container -->
	</div>
	<!-- END register -->
@endsection
