@extends('layouts.app')

@section('title', 'Selección de Tipo de Persona')

@push('css')

@endpush

@push('scripts')

<script>
$('[data-toggle="tooltip"]').tooltip()
</script>
@endpush
@section('content')
	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item"><a href="/">Inicio</a></li>
        <li class="breadcrumb-item">Empresa</li>
        <li class="breadcrumb-item active">Selección</li>
	</ol>
	<!-- END breadcrumb -->
	<!-- BEGIN page-header -->
	<h1 class="page-header">Empresa <small> - Información General</small></h1>
	<!-- END page-header -->

<!-- BEGIN row -->
<div class="row">
    <!-- BEGIN col-12 -->
    <div class="col-xl-12">

        <!-- BEGIN panel -->
        <div class="panel panel-inverse" data-sortable-id="index-1">
            <div class="panel-heading">
                <h4 class="panel-title">Selección de tipo de Persona</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{ route('empresa.seleccionEnviada') }}" autocomplete="off" id="formSeleccion">
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
                            <label class="form-label col-form-label col-md-3">Tipo <i class="fas fa-circle-info" data-toggle="tooltip" title="Moral o Física"></i></label>
                            <div class="col-md-9 pt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="1" id="tipo1" name="seleccion" />
                                    <label class="form-check-label" for="tipo1"><b>Moral</b></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="2" id="tipo2" name="seleccion" />
                                    <label class="form-check-label" for="tipo"><b>Física</b></label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary w-100px">Enviar</button>
                            </div>
                        </div>
                    </fieldset>
                </form>


            </div>
        </div>
        <!-- END panel -->

    </div>
    <!-- END col-12 -->
</div>
<!-- END row -->


@endsection
