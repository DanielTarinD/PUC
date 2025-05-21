@extends('layouts.app')

@section('title', 'Registrar Usuario')

@push('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.css"/>

    <style>
            form i {
                margin-left: -25px;
                margin-top: 11px;
                cursor: pointer;
            }
    </style>
@endpush

@push('scripts')

<script src="../assets/plugins/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(function () {

        $("body").on("click","#togglePassword", function () {
            var passwordField = document.getElementById('password');
            var passwordConfirmationField = document.getElementById('password_confirmation');
            var value = passwordField.value;

            if(passwordField.type == 'password') {
                passwordField.type = 'text';
                passwordConfirmationField.type = 'text';
            }
            else {
                passwordField.type = 'password';
                passwordConfirmationField.type = 'password';
            }

            passwordField.value = value;

            $(this).toggleClass( "fa-eye fa-eye-slash");



        });
    });

</script>

@endpush

@section('content')

	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>

        <li class="breadcrumb-item"><a href="/usuarios">Usuarios</a></li>

		<li class="breadcrumb-item active">Nuevo</li>
	</ol>
	<!-- END breadcrumb -->


	<!-- BEGIN page-header -->
	<h1 class="page-header">Nuevo Usuario <small></small></h1>
	<!-- END page-header -->

	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-12 -->
		<div class="col-xl-12">
			<!-- BEGIN panel -->
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<h4 class="panel-title">Datos del Usuario</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
				</div>
				<!-- BEGIN panel-body -->
				<div class="panel-body">
                        <form method="POST" action="{{ route('register.custom') }}" autocomplete="off">
                            @csrf
                            <fieldset>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row mb-3">
                                    <label class="form-label col-form-label col-md-3">Rol</label>
                                    <div class="col-md-9">
                                        <select class="form-select" name="rol">
                                            <option value="" disabled selected>Seleccione un Rol</option>
                                            <option value="Jefatura">Jefatura</option>
                                            <option value="Supervisor">Supervisor</option>
                                            <option value="Administrador">Administrador</option>
                                            <option value="Revisor">Revisor</option>
                                            <option value="Contralor">Contralor</option>

                                        </select>

                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="form-label col-form-label col-md-3">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" placeholder="Nombre Completo" />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="form-label col-form-label col-md-3">RFC</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="rfc" placeholder="RFC" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="form-label col-form-label col-md-3">Correo Electronico</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="email" placeholder="Correo Electrónico" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="form-label col-form-label col-md-3">Contraseña</label>
                                    <div class="col-md-9">
                                        <div class="d-flex flex-row">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="******">
                                            <i class="fa fa-eye-slash" id="togglePassword"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="form-label col-form-label col-md-3">Confirma Contraseña</label>
                                    <div class="col-md-9">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="******">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary w-100px">Guardar</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>

				</div>
				<!-- END panel-body -->
			</div>
			<!-- END panel -->
		</div>
		<!-- END col-12 -->
	</div>
	<!-- END row -->


@endsection
