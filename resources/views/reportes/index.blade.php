@extends('layouts.app')

@section('title', 'Reportes')

@push('css')
	<link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush

@push('scripts')
	<script src="../assets/plugins/sweetalert/dist/sweetalert.min.js"></script>

    <script type="text/javascript">

    </script>

@endpush
@section('content')
	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item active">Reportes</li>
	</ol>
	<!-- END breadcrumb -->
	<!-- BEGIN page-header -->
	<h1 class="page-header">Reportes</h1>
	<!-- END page-header -->


    <!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-12 -->
		<div class="col-xl-12">
			<!-- BEGIN panel -->
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<h4 class="panel-title">Reportes</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
				</div>
				<!-- BEGIN panel-body -->
				<div class="panel-body">

                    <form method="POST" action="{{ route('reportes.generar') }}" autocomplete="off" id="reporte">
                        @csrf
                        <fieldset>

                            <div class="row mb-3">
                                <label class="form-label col-form-label col-md-3">Reporte </label>
                                <div class="col-md-9">
                                    <select class="form-select" name="reporte" id="reporte">
                                        <option value="empresas" >Inicial (Excel)</option>
                                        <option value="refrendos" >Refrendos (Excel)</option>
                                        <option value="inscripcion" >Inscripciones (PDF)</option>
                                        <option value="refrendo" >Refrendo(PDF)</option>
                                        <option value="productividad" >Productividad(Excel)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 15px;">
                                <div class="d-flex justify-content-end">

                                    <button type="submit" id="enviarReporte" class="btn btn-red w-100px">Generar</button>

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
