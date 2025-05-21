@extends('layouts.app')

@section('title', 'Areas |  Nueva')

@push('css')

@endpush

@push('scripts')

@endpush

@section('content')

	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
		<li class="breadcrumb-item">Catalogos</li>
		<li class="breadcrumb-item"><a href="/catalogos/areas">Areas</a></li>

		<li class="breadcrumb-item active">Nueva</li>

	</ol>
	<!-- END breadcrumb -->


	<!-- BEGIN page-header -->
	<h1 class="page-header">Areas<small> Nueva</small></h1>
	<!-- END page-header -->



	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-12 -->
		<div class="col-xl-12">
			<!-- BEGIN panel -->
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<h4 class="panel-title">Nueva Area
					</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
				</div>
				<!-- BEGIN panel-body -->
				<div class="panel-body">


					<form action="/catalogos/areas" method="POST" autocomplete="off">
						@csrf
						<fieldset>
							<legend class="mb-3">Datos Generales</legend>
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
								<label class="form-label col-form-label col-md-3">Entidad Ejecutora</label>
								<div class="col-md-9">
									<select class="form-select"  name="entidadejecutora_id">
										<option value="" disabled selected>Entidad Ejecutora</option>
										@foreach($entidadesEjecutoras as $entidadEjecutora)
											<option value="{{ $entidadEjecutora->id }}">{{ $entidadEjecutora->siglas }} - {{ $entidadEjecutora->nombre }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="row mb-3">
								<label class="form-label col-form-label col-md-3">Nombre</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre del Area" />
								</div>
							</div>

							<div class="row mb-3">
								<label class="form-label col-form-label col-md-3">Descripción</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" placeholder="Breve descripción del Area" />
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
