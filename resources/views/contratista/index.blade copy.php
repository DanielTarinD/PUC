@extends('layouts.app')

@section('title', 'Inicio')

@push('css')
<style>
.sdupot-color {
    background-color: #ab0033;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/translations/es.js"></script>
@endpush
@section('content')
	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item active">Inicio</li>
	</ol>
	<!-- END breadcrumb -->
	<!-- BEGIN page-header -->
	<h1 class="page-header">Dashboard </h1>
	<!-- END page-header -->

    @if (isset($empresa))
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-3 -->
            <div class="col-xl-12 col-md-6">
                <div class="widget widget-stats {{ ($empresa->estatus == "R" || $empresa->estatus == "O") ? 'bg-warning' : 'sdupot-color' }}">
                    <div class="stats-icon"><i class="fas fa-building"></i></div>
                    <div class="stats-info">
                        <h4>Empresa</h4>
                        <p>{{ isset($empresa->nombre_empresa) == "" ? 'No existen datos registrados.' : ($empresa->tipo == "1" ? $empresa->nombre_empresa : $empresa->nombre_persona)  }}
                            @if ($empresa->estatus == "R")
                            - en Revisión
                            @elseif ($empresa->estatus == "O")
                            - con Observaciones
                            @endif
                        </p>

                        <h5>{{ isset($empresa->rfc_empresa) == "" ? '' : $empresa->rfc_empresa }}</h5>
                    </div>
                    <div class="stats-link">
                        <a href="/empresa/informativo">Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- END col-3 -->
        </div>
        <!-- END row -->
    @else
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-3 -->
            <div class="col-xl-12 col-md-6">
                <div class="widget widget-stats sdupot-color">
                    <div class="stats-icon"><i class="fas fa-building"></i></div>
                    <div class="stats-info">
                        <h4>Empresa</h4>
                        <p>No existen datos registrados.</p>
                        <h5>N/A</h5>
                    </div>
                    <div class="stats-link">
                        <a href="/empresa/informativo">Detalles <i class="fa fa-arrow-alt-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- END col-3 -->
        </div>
        <!-- END row -->
    @endif

<!-- BEGIN row -->
<div class="row">
    <!-- BEGIN col-12 -->
    <div class="col-xl-12">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <!-- BEGIN panel -->
        <div class="panel panel-inverse" data-sortable-id="index-1">
            <div class="panel-heading">
                <h4 class="panel-title">Observaciones</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <b>Observaciones del Área de Padrón:</b>
                <div class="row">
                    <div class="col-md-12">
                        <textarea name="obras" id="editorObras">
                            {{ isset($empresa->observaciones->obras)? $empresa->observaciones->obras : 'Obras no ha hecho alguna Observación' }}
                        </textarea>
                        <script>
                                window.addEventListener("load", (e)=>{
                                    ClassicEditor.create( document.querySelector( '#editorObras' ),{
                                        language: 'es',
                                    } )
                                    .then( editor => {
                                        const toolbarElement = editor.ui.view.toolbar.element;
                                        console.log( editor );
                                        toolbarElement.style.display = 'none';
                                    } )
                                    .catch( error => {
                                        console.error( error );
                                    } );
                                });
                        </script>
                    </div>
                </div>
                <br /><br />
                <b>Observaciones de Contraloría:</b>
                <div class="row">
                    <div class="col-md-12">
                        <textarea name="obras" id="editorContraloria">
                            {{ isset($empresa->observaciones->contraloria)? $empresa->observaciones->contraloria : 'Contraloría no ha hecho alguna Observación' }}
                        </textarea>
                        <script>
                                window.addEventListener("load", (e)=>{
                                    ClassicEditor.create( document.querySelector( '#editorContraloria' ),{
                                        language: 'es',
                                    } )
                                    .then( editor => {
                                        const toolbarElement = editor.ui.view.toolbar.element;
                                        console.log( editor );
                                        toolbarElement.style.display = 'none';
                                    } )
                                    .catch( error => {
                                        console.error( error );
                                    } );
                                });
                        </script>
                    </div>
                </div>





            </div>
        </div>
        <!-- END panel -->

    </div>
    <!-- END col-12 -->
</div>
<!-- END row -->


@endsection
