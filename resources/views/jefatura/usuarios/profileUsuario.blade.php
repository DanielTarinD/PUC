@extends('layouts.app')

@section('title', 'Perfil')

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
            var value = passwordField.value;

            if(passwordField.type == 'password') {
                passwordField.type = 'text';
            }
            else {
                passwordField.type = 'password';
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
		<li class="breadcrumb-item"><a href="/">Inicio</a></li>

		<li class="breadcrumb-item active">Perfil</li>
	</ol>
	<!-- END breadcrumb -->


	<!-- BEGIN page-header -->
	<h1 class="page-header">Perfil <small></small></h1>
	<!-- END page-header -->

	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-12 -->
		<div class="col-xl-12">
			<!-- BEGIN panel -->
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<h4 class="panel-title">Perfil</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
				</div>
				<!-- BEGIN panel-body -->
				<div class="panel-body">


                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-column align-items-center text-center py-5">
                                    <img class="rounded-circle mt-5" width="128px" src="{{ asset('storage/avatars/'.auth()->user()->avatar) }}">
                                    <span class="font-weight-bold">{{ $perfil->name }}</span>
                                    <span class="text-black-50">
                                        @forelse (auth()->user()->roles->take(1) as $role)
                                            {{$role->name}}
                                        @empty
                                            Sin Asginar Rol
                                        @endforelse
                                    </span>
                                    <span>  </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <form action="/jefatura/perfil" method="POST" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div class="p-3 py-5">

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right">Datos de Perfil</h4>
                                        </div>
                                        <input type="hidden" name="identificador" value="{{ $perfil->id }}">

                                        <div class="row mt-2">
                                            <div class="col-md-6"><label class="labels">RFC</label><input type="text" class="form-control" placeholder="RFC" name="rfc_empresa" value="{{ $perfil->rfc }}"></div>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-6"><label class="labels">Nombre</label><input type="text" class="form-control" placeholder="Nombre" name="nombre" value="{{ $perfil->name }}"></div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-6"><label class="labels">Correo</label><input type="text" class="form-control" placeholder="Correo Electronico" name="email" value="{{ $perfil->email }}"></div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <label class="labels">Contraseña</label>
                                                <div class="d-flex flex-row">
                                                    <input type="password" name="password" id="password" class="form-control" placeholder="******" value="">
                                                    <i class="fa fa-eye-slash" id="togglePassword"></i>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mt-3 text-center">
                                            <div class="col-md-6">
                                                <button class="btn btn-primary profile-button" type="submit">Actualizar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


				</div>
				<!-- END panel-body -->
			</div>
			<!-- END panel -->
		</div>
		<!-- END col-12 -->
	</div>
	<!-- END row -->


@endsection
