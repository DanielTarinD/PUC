@extends('layouts.app')

@section('title', 'DV |  Editar')

@push('css')
	<link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
@endpush

@push('scripts')
	<script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="/assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js"></script>


	<script>
			$("#datepicker-fecha").datepicker({
                language: 'es',
                todayHighlight: true,
				autoclose: true
			});
	</script>
@endpush

@section('content')

	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>
		<li class="breadcrumb-item"><a href="/dv">DV</a></li>

		<li class="breadcrumb-item active">Editar</li>

	</ol>
	<!-- END breadcrumb -->


	<!-- BEGIN page-header -->
	<h1 class="page-header">DV<small> Editar</small></h1>
	<!-- END page-header -->



	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-12 -->
		<div class="col-xl-12">
			<!-- BEGIN panel -->
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<h4 class="panel-title">Datos Generales
					</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
				</div>
				<!-- BEGIN panel-body -->
				<div class="panel-body">

					<form action="{{ route('dv.update', ['dv' => $dv]) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
						@csrf
                        @method('PATCH')
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
								<label class="form-label col-form-label col-md-3">Fecha</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="fecha" value="{{ $dv->fecha }}" id="datepicker-fecha" />
								</div>
							</div>

							<div class="row mb-3">
								<label class="form-label col-form-label col-md-3">Folio</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="folio" value="{{ $dv->folio }}" placeholder="Folio" />
								</div>
							</div>

							<div class="row mb-3">
								<label class="form-label col-form-label col-md-3">Descripción</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="descripcion" value="{{ $dv->descripcion }}" placeholder="Descripción" />
								</div>
							</div>

                            <div class="row mb-3">
                                <label class="form-label col-form-label col-md-3">DV Digitalizado</label>
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
