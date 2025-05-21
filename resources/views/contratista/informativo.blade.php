@extends('layouts.app')

@section('title', 'Información')

@push('css')
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
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/translations/es.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function () {

    $('[data-toggle="tooltip"]').tooltip();

    $('#enviar').on('click',function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        Swal.fire({
                title: "ATENCION !!!",
                text: "Una vez que envié los datos capturados no podrá modificarlos hasta que sean validados u observados",
                icon: "warning",
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Enviar',
                cancelButtonText: 'Cancelar',
                }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
        })
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


                    <div class="accordion-item border-0">
                        <div class="accordion-header" id="headingObservaciones">
                        <button class="accordion-button text-white px-3 py-10px pointer-cursor" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObservaciones">
                            <i class="fa fa-circle fa-fw  text-red me-2 fs-8px"></i> <b>Observaciones Pendientes</b>
                        </button>
                        </div>
                        <div id="collapseObservaciones" class="accordion-collapse" data-bs-parent="#accordion">
                        <div class="accordion-body bg-white text-black">

                            <div class="row">
                                <div class="col-md-12">
                                    <textarea name="empresa_observaciones" id="editorObservaciones">
                                        {{ isset($empresa->observaciones->obras) ? $empresa->observaciones->obras : 'No existen Observaciones' }}
                                    </textarea>
                                    <script>
                                            window.addEventListener("load", (e)=>{
                                                ClassicEditor.create( document.querySelector('#editorObservaciones' ),{
                                                } )
                                                .then(editor => {
                                                    editor.isReadOnly; // `false`.
                                                        editor.enableReadOnlyMode( '#editorObservaciones' );
                                                        const toolbarElement = editor.ui.view.toolbar.element;
                                                        toolbarElement.style.display = 'none';
                                                } ) .catch( error => {
                                                    console.error( error );
                                                } );
                                            });
                                    </script>
                                </div>
                            </div>

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
