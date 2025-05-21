@extends('layouts.app')

@section('title', 'Información')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.css"/>

<style>

.accordion-button {
    color: #ffffff;
    background-color: #ab0033;
}

.accordion-button:not(.collapsed) {
    color: #ffffff;
    background-color: #ab0033;
}

.text-sduopot {
    color: rgba(221, 201, 163, 1);
}

.accordion-button:not(.collapsed)::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

.accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}

</style>

@endpush


@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src='{{ asset('assets/plugins/ckeditor5/ckeditor.js') }}'></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.js"></script>

<script>
$(function () {

    $('[data-toggle="tooltip"]').tooltip();

    Swal.fire({
                title: "ATENCION !!!",
                text: "El período para realizar Refrendos ha finalizado, si tiene datos en revisión será notificado si existe alguna observación y podrá continuar con su proceso.",
                icon: "warning",
        });


});


$(function () {


var table = $('#dataTableEspecialidades').DataTable({
    ajax: "{{ route('especialidades.refrendo.list') }}",
    serverSide: true,
    processing: true,
    bFilter: false,
    bLengthChange: false,
    columns: [
        {data: 'especialidad.nombre', name: 'especialidad.nombre'},
        {data: 'link_especialidad', name: 'link_especialidad', orderable: false, searchable: false, exportable: false},
        {data: 'ejercicio', name: 'ejercicio'},

    ],
    responsive: true,
    language: {
        url: '//cdn.datatables.net/plug-ins/1.11.1/i18n/es-mx.json'
    },
    columnDefs: [
        {
            targets: 1,
            className: 'dt-body-center'
        },
        {
            targets: 2,
            className: 'dt-body-center'
        }
    ],
    pageLength: 25,
});

});

</script>
@endpush
@section('content')
	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item active">Inicio</li>
	</ol>
	<!-- END breadcrumb -->
	<!-- BEGIN page-header -->
	<h1 class="page-header">Dashboard <small>Información de Captura</small></h1>
	<!-- END page-header -->



<!-- BEGIN row -->
<div class="row">
    <!-- BEGIN col-12 -->
    <div class="col-xl-12">

        <!-- BEGIN panel -->
        <div class="panel panel-inverse" data-sortable-id="index-1">
            <div class="panel-heading">
                <h4 class="panel-title">Información de los Refrendos</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">

                @foreach ($empresa->refrendos as $refrendo)


                        <div class="accordion" id="accordion">
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingGeneral">
                                    <button class="accordion-button text-white px-3 py-10px pointer-cursor" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRefrendo{{ $refrendo->ejercicio }}">
                                        <i class="fa fa-circle fa-fw text-sduopot me-2 fs-8px"></i> <b>{{ $refrendo->ejercicio }}</b>
                                    </button>
                                </div>
                                <div id="collapseRefrendo{{ $refrendo->ejercicio }}" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                <div class="accordion-body bg-white text-black">

                                    @include('includes.informativo.refrendo')

                                </div>
                            </div>
                        </div>


                @endforeach

            </div>


    </div>
    <!-- END col-12 -->
</div>
<!-- END row -->


<!-- BEGIN row -->
<div class="row">
    <!-- BEGIN col-12 -->
    <div class="col-xl-12">

        <!-- BEGIN panel -->
        <div class="panel panel-inverse" data-sortable-id="index-1">
            <div class="panel-heading">
                <h4 class="panel-title">Informacion de la Empresa</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <i class="fa fa-circle fa-fw text-sduopot me-2 fs-8px"></i> <b>Información Capturada</b>&nbsp; &nbsp;
                        <i class="fa fa-circle fa-fw text-red me-2 fs-8px"></i> <b>Información Faltante</b>
                    </div>
                </div>
                <br />
                <div class="accordion" id="accordion">
                    <div class="accordion-item border-0">
                        <div class="accordion-header" id="headingGeneral">
                        <button class="accordion-button text-white px-3 py-10px pointer-cursor" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGeneral">
                            <i class="fa fa-circle fa-fw text-sduopot me-2 fs-8px"></i> <b>Información General</b>
                        </button>
                        </div>
                        <div id="collapseGeneral" class="accordion-collapse collapse" data-bs-parent="#accordion">
                        <div class="accordion-body bg-white text-black">

                            @include('includes.informativo.gral')

                        </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0">
                        <div class="accordion-header" id="headingLegal">
                        <button class="accordion-button text-white px-3 py-10px pointer-cursor" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLegal">
                            <i class="fa fa-circle fa-fw {{ $empresa->legales()->exists() ? 'text-sduopot' : 'text-red' }} me-2 fs-8px"></i> <b>Información Legal</b>
                        </button>
                        </div>
                        <div id="collapseLegal" class="accordion-collapse collapse" data-bs-parent="#accordion">
                        <div class="accordion-body bg-white text-black">

                            @if($empresa->legales()->exists())
                                @include('includes.informativo.legal')
                            @endif


                        </div>
                        </div>
                    </div>

                    @if($empresa->tipo == '1')
                        <div class="accordion-item border-0">
                            <div class="accordion-header" id="headingRepresentante">
                            <button class="accordion-button text-white px-3 py-10px pointer-cursor" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRepresentante">
                                <i class="fa fa-circle fa-fw {{ $empresa->representantes()->exists() ? 'text-sduopot' : 'text-red' }} me-2 fs-8px"></i> <b>Información del Representante Legal</b>
                            </button>
                            </div>
                            <div id="collapseRepresentante" class="accordion-collapse collapse" data-bs-parent="#accordion">
                            <div class="accordion-body bg-white text-black">

                                @if($empresa->representantes()->exists())
                                    @include('includes.informativo.representante')
                                @endif


                            </div>
                            </div>
                        </div>
                    @endif

                    <div class="accordion-item border-0">
                        <div class="accordion-header" id="headingContable">
                        <button class="accordion-button text-white px-3 py-10px pointer-cursor" type="button" data-bs-toggle="collapse" data-bs-target="#collapseContable">
                            <i class="fa fa-circle fa-fw {{ $empresa->contables()->exists() ? 'text-sduopot' : 'text-red' }} me-2 fs-8px"></i> <b>Información Contable</b>
                        </button>
                        </div>
                        <div id="collapseContable" class="accordion-collapse collapse" data-bs-parent="#accordion">
                        <div class="accordion-body bg-white text-black">

                            @if($empresa->contables()->exists())
                                @include('includes.informativo.contable')
                            @endif

                        </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0">
                        <div class="accordion-header" id="headingTecnica">
                        <button class="accordion-button text-white px-3 py-10px pointer-cursor" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTecnica">
                            <i class="fa fa-circle fa-fw {{ $empresa->tecnicas()->exists() ? 'text-sduopot' : 'text-red' }} me-2 fs-8px"></i> <b>Información Técnica</b>
                        </button>
                        </div>
                        <div id="collapseTecnica" class="accordion-collapse collapse" data-bs-parent="#accordion">
                        <div class="accordion-body bg-white text-black">


                            @if($empresa->tecnicas()->exists())
                                @include('includes.informativo.tecnica')
                            @endif

                        </div>
                        </div>
                    </div>



                </div>
                <br />   <br />
                @if ( $empresa->estatus == "R"  )
                        <input type="hidden" class="form-control" name="empresa_id" value="{{ $empresa->id }}" readonly />
                        <div class="row">
                            <div class="d-flex">
                                <h3>Notas para su Revisión.</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="empresa_nota" id="editor">
                                    {{ $empresa->empresa_nota }}
                                </textarea>
                                <script>
                                        window.addEventListener("load", (e)=>{
                                            ClassicEditor.create( document.querySelector('#editor' ),{
                                            } )
                                            .then(editor => {
                                                editor.isReadOnly; // `false`.
                                                    editor.enableReadOnlyMode( '#editor' );
                                                    const toolbarElement = editor.ui.view.toolbar.element;
                                                    toolbarElement.style.display = 'none';
                                            } ) .catch( error => {
                                                console.error( error );
                                            } );
                                        });
                                </script>
                            </div>
                        </div>
                @elseif($empresa->estatus == "N" || $empresa->estatus == "O")
                    <form method="POST" action="{{ route('empresa.enviar') }}" autocomplete="off" id="formEnviar">
                        @csrf
                        <input type="hidden" class="form-control" name="empresa_id" value="{{ $empresa->id }}" readonly />
                        <div class="row">
                            <div class="d-flex">
                                <h3>Escriba algunas notas que considere importantes para la revisión de sus datos.</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="empresa_nota" id="editor">
                                    {{ old('empresa_nota', $empresa->empresa_nota) }}
                                </textarea>
                                <script>
                                        window.addEventListener("load", (e)=>{
                                            ClassicEditor.create( document.querySelector( '#editor' ),{
                                                language: 'es',
                                                toolbar: [ 'bold', 'italic', 'link', 'undo', 'redo', 'numberedList', 'bulletedList' ],
                                            } )
                                            .then( editor => {
                                                console.log( editor );
                                            } )
                                            .catch( error => {
                                                console.error( error );
                                            } );
                                        });
                                </script>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 15px;">
                            <div class="d-flex justify-content-end">
                                <button type="submit" id="enviar" class="btn btn-red w-100px">Enviar</button>
                            </div>
                        </div>
                    </form>
                @endif

            </div>
        </div>
        <!-- END panel -->

    </div>
    <!-- END col-12 -->
</div>
<!-- END row -->




@endsection
