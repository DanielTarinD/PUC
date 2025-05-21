@extends('layouts.app')

@section('title', 'Contraloría')

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
<script src='{{ asset('assets/plugins/ckeditor5/ckeditor.js') }}'></script>
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
                text: "Las observaciones se guardarán, esta seguro de esta acción ?",
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

    $('#validar').on('click',function(e){
        var token = $("meta[name='csrf-token']").attr("content");
        var id = {{ $empresa->id }};
        var obras_id = $('#obras_id').val();
        var obras =  myEditor.getData();


        Swal.fire({
                title: "ATENCION !!!",
                text: "Validar los datos es una accion irreversible y permitira al Contratista obtener su Constancia, esta seguro de esta acción ? ",
                icon: "warning",
                showCancelButton: true,
                reverseButtons: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Enviar',
                cancelButtonText: 'Cancelar',
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax(
								{
									url: "validar",
									type: 'post',
									data: {
										"id": id,
                                        "obras_id": obras_id,
                                        "obras": obras,
										"_token": token,
									},
									success: function (data){
                                        console.log(data);
                                        window.location.href = '/';
									}
								});
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
	<h1 class="page-header">Dashboard <small>Información de la Empresa</small></h1>
	<!-- END page-header -->


<!-- BEGIN row -->
<div class="row">
    <!-- BEGIN col-12 -->
    <div class="col-xl-12">

        <!-- BEGIN panel -->
        <div class="panel panel-inverse" data-sortable-id="index-1">
            <div class="panel-heading">
                <h4 class="panel-title">Informacion de la Empresa - "{{ $empresa->tipo == '1' ? $empresa->nombre_empresa : $empresa->nombre_persona }}"</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">

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
                            <i class="fa fa-circle fa-fw {{ !empty($empresa) ? 'text-sduopot' : 'text-red' }} me-2 fs-8px"></i> <b>Información General</b>
                        </button>
                        </div>
                        <div id="collapseGeneral" class="accordion-collapse collapse" data-bs-parent="#accordion">
                        <div class="accordion-body bg-white text-black">

                            @if(!empty($empresa))
                                @include('includes.informativo.gral')
                            @endif

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
                            <i class="fa fa-circle fa-fw {{ $empresa->observaciones()->exists() ? 'text-sduopot' : 'text-red' }} me-2 fs-8px"></i> <b>Observaciones Área del Padrón</b>
                        </button>
                        </div>
                        <div id="collapseObservaciones" class="accordion-collapse collapse" data-bs-parent="#accordion">
                        <div class="accordion-body bg-white text-black">
                            @if($empresa->observaciones()->exists())
                                @include('includes.informativo.observacionesObras')
                            @endif
                        </div>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                        <div class="d-flex">
                            <h3>Nota para la revisión hecha por el Contratista:</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="empresa_nota" id="editorEmpresaNota">
                                {{ isset($empresa->empresa_nota)? $empresa->empresa_nota : 'El registro no tiene alguna Nota.' }}
                            </textarea>
                            <script>
                                    window.addEventListener("load", (e)=>{
                                        ClassicEditor.create( document.querySelector( '#editorEmpresaNota' ),{
                                            language: 'es',
                                            toolbar: [],
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

                    <br />   <br />
                    <form method="POST" action="{{ route('contralor.observaciones') }}" autocomplete="off" id="formEnviar">
                        @csrf
                        <input type="hidden" class="form-control" name="empresa_id" value="{{ $empresa->id }}" readonly />
                        <input type="hidden" class="form-control" name="contraloria_id" value="{{ auth()->user()->id }}" readonly />
                        <div class="row">
                            <div class="d-flex">
                                <h3>Observaciones Realizadas:</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="contraloria" id="editor" placeholder="{{ isset($empresa->observaciones->contraloria)? '' : 'No ha hecho alguna Observación' }}">

                                    {{isset($empresa->observaciones->contraloria)? $empresa->observaciones->contraloria : '' }}

                                </textarea>
                                <script>
                                        window.addEventListener("load", (e)=>{
                                            ClassicEditor.create( document.querySelector( '#editor' ),{

                                            } )
                                            .then( editor => {
                                                console.log( editor );
                                                myEditor = editor;
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
                                <button type="button" id="validar" class="btn btn-blue w-100px">Validar</button>&nbsp;
                                <button type="submit" id="enviar" class="btn btn-red w-100px">Enviar</button>
                            </div>
                        </div>
                    </form>



                </div>
                <br />
            </div>
        </div>
        <!-- END panel -->

    </div>
    <!-- END col-12 -->
</div>
<!-- END row -->


@endsection
