@extends('layouts.app')

@section('title', 'Inicio')

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
		<li class="breadcrumb-item active">Inicio</li>
	</ol>
	<!-- END breadcrumb -->
	<!-- BEGIN page-header -->
	<h1 class="page-header">Dashboard <small>Información General</small></h1>
	<!-- END page-header -->

	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-3 -->
		<div class="col-xl-3 col-md-6">
			<div class="widget widget-stats bg-blue">
				<div class="stats-icon"><i class="fas fa-circle-check"></i></div>
				<div class="stats-info">
					<h4>COMPLETOS</h4>
					<p>{{ $completas }}</p>
				</div>
				<div class="stats-link">
					<a href="javascript:;">Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
		<!-- END col-3 -->
		<!-- BEGIN col-3 -->
		<div class="col-xl-3 col-md-6">
			<div class="widget widget-stats bg-info">
				<div class="stats-icon"><i class="fa fa-link"></i></div>
				<div class="stats-info">
					<h4>PREREGISTROS</h4>
					<p>{{{ $preregistros }}}</p>
				</div>
				<div class="stats-link">
					<a href="javascript:;">Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
		<!-- END col-3 -->
		<!-- BEGIN col-3 -->
		<div class="col-xl-3 col-md-6">
			<div class="widget widget-stats bg-orange">
				<div class="stats-icon"><i class="fas fa-circle-half-stroke"></i></div>
				<div class="stats-info">
					<h4>INCOMPLETAS</h4>
					<p>{{ $incompletas }}</p>
				</div>
				<div class="stats-link">
					<a href="javascript:;">Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
		<!-- END col-3 -->
		<!-- BEGIN col-3 -->
		<div class="col-xl-3 col-md-6">
			<div class="widget widget-stats bg-red">
				<div class="stats-icon"><i class="fas fa-magnifying-glass-plus"></i></div>
				<div class="stats-info">
					<h4>OBSERVADAS</h4>
					<p>{{ $observadas }}</p>
				</div>
				<div class="stats-link">
					<a href="javascript:;">Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
		<!-- END col-3 -->
	</div>
	<!-- END row -->


@endsection
