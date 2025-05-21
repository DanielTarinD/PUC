@extends('layouts.app')

@section('title', 'Información Legal')

@push('css')
<link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />


@endpush

@push('scripts')
<script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="/assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js"></script>

<script>
    $("#datepicker-fechaEscritura, #datepicker-fechaMercantil").datepicker({
        todayHighlight: true,
        format: 'dd-mm-yyyy',
        autoclose: true,
        language: 'es',
        weekStart: 0,
    });
</script>



@endpush
@section('content')
	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item"><a href="/">Inicio</a></li>
        <li class="breadcrumb-item">Empresa</li>
        <li class="breadcrumb-item active">Información Legal</li>
	</ol>
	<!-- END breadcrumb -->
	<!-- BEGIN page-header -->
	<h1 class="page-header">Empresa <small> - Persona {{ $tipoPersona }}</small></h1>
	<!-- END page-header -->

<!-- BEGIN row -->
<div class="row">
    <!-- BEGIN col-12 -->
    <div class="col-xl-12">

        <!-- BEGIN panel -->
        <div class="panel panel-inverse" data-sortable-id="index-1">
            <div class="panel-heading">
                <h4 class="panel-title">Formulario PC-1{{  substr($tipoPersona, 0, 1)  }} - Información Legal</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">
                @include('includes.contratista.legalUpdate')
            </div>
        </div>
        <!-- END panel -->

    </div>
    <!-- END col-12 -->
</div>
<!-- END row -->


@endsection
