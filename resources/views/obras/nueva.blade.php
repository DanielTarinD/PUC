@extends('layouts.app')

@section('title', 'Obras |  Nueva')

@push('css')

@endpush

@push('scripts')


@endpush

@section('content')

	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
		<li class="breadcrumb-item"><a href="/obras">Obras</a></li>

		<li class="breadcrumb-item active">Nueva</li>

	</ol>
	<!-- END breadcrumb -->


	<!-- BEGIN page-header -->
	<h1 class="page-header">Obras<small> Nueva</small></h1>
	<!-- END page-header -->



	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-12 -->
		<div class="col-xl-12">
			<!-- BEGIN panel -->
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<h4 class="panel-title">Nueva Obra
					</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
				</div>
				<!-- BEGIN panel-body -->
				<div class="panel-body">

					<form action="/obras" method="POST" autocomplete="off" enctype="multipart/form-data">
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
								<label class="form-label col-form-label col-md-3">Nombre de la Escuela o Institución</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre de la Escuela o Institución" />
								</div>
							</div>

							<div class="row mb-3">
								<label class="form-label col-form-label col-md-3">CCT</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="cct" value="{{ old('cct') }}" placeholder="Número de CCT" />
								</div>
							</div>

							<div class="row mb-3">
								<label class="form-label col-form-label col-md-3">Ubicación</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="localidad" value="{{ old('localidad') }}" placeholder="Ubicación o Localidad" />
								</div>
							</div>

							<div class="row mb-3">
								<label class="form-label col-form-label col-md-3">Domicilio</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="domicilio" value="{{ old('domicilio') }}" placeholder="Domicilio" />
								</div>
							</div>

							<div class="row mb-3">
								<label class="form-label col-form-label col-md-3">Fuente de Financiamiento</label>
								<div class="col-md-9">
									<select class="form-select"  name="fuente_id">
										<option value="" disabled selected>Fuente</option>
										@foreach($fuentes as $fuente)
											<option value="{{ $fuente->id }}">{{ $fuente->nombre}} - {{ $fuente->ejercicio->ejercicio }}</option>
										@endforeach
									</select>

								</div>
							</div>

							<div class="row mb-3">
								<label class="form-label col-form-label col-md-3">Número de PGO</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="pgo" value="{{ old('pgo') }}" placeholder="Número asignado de PGO" />
								</div>
							</div>

							<div class="row mb-3">
								<label class="form-label col-form-label col-md-3">Modalidad</label>
								<div class="col-md-9">
									<select class="form-select"  name="modalidadcontratacion_id">
										<option value="" disabled selected>Modalidad</option>
										@foreach($modalidades as $modalidad)
											<option value="{{ $modalidad->id }}">{{ $modalidad->nombre}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="row mb-3">
								<label class="form-label col-form-label col-md-3">Acuerdo</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="acuerdo" value="{{ old('acuerdo') }}" placeholder="Número de Acuerdo de Autorizacion de la Obra" />
								</div>
							</div>

							<div class="row mb-3">
								<label class="form-label col-form-label col-md-3">Monto Original</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="monto_original" value="{{ old('monto_original') }}" placeholder="Monto Original de la Obra" />
								</div>
							</div>

                            <div class="row mb-3">
                                <label class="form-label col-form-label col-md-3">Anexo Digital</label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control form-control-sm" name="file" >
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
