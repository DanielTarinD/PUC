@extends('layouts.app')

@section('title', 'Inicio')

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

    @if ($refrendo->estatus == 'O' || $refrendo->estatus == 'V')

    @else


        $('#enviar').on('click',function(e){
            e.preventDefault();
            var form = $(this).parents('form');
            Swal.fire({
                    title: "ATENCION !!!",
                    text: "Las Observaciones se enviarán al Contratista para su corrección.",
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
            var id = {{ $refrendo->id }};
            var obras_id = $('#obras_id').val();
            var empresa_id = $('#empresa_id').val();
            var refrendo_id = $('#refrendo_id').val();
            var obras =  myEditor.getData();



            Swal.fire({
                    title: "ATENCIÓN !!!",
                    text: "Validar los datos es una acción irreversible y permitira al Contratista obtener su Constancia, esta seguro de esta acción ? ",
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
                                            "empresa_id": empresa_id,
                                            "refrendo_id": refrendo_id,
                                            "obras": obras,
                                            "_token": token,
                                        },
                                        success: function (data){
                                            console.log(data);
                                            window.location.href = "/";
                                        },
                                        error: function (xhr, ajaxOptions, thrownError) {
                                            alert(xhr.status);
                                            alert(thrownError);
                                        }
                                    });
                    }
            })
        });

    @endif


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
                    <h4 class="panel-title">Informacion de la Empresa - "{{ $refrendo->empresa->tipo == '1' ? $refrendo->empresa->nombre_empresa : $refrendo->empresa->nombre_persona }}" para el Refrendo 2023.</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                </div>
                <div class="panel-body">


                    <div class="row mb-3">
                        <label class="form-label col-form-label col-md-3">Solicitud de Refrendo</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" value="{{$refrendo->solicitud_refrendo}}"  readonly/>
                        </div>

                        <div class="col-md-2">
                            <a href='{{$refrendo->solicitud_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="form-label col-form-label col-md-3">Acta Constitutiva</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" value="{{$refrendo->acta_refrendo}}"  readonly/>
                        </div>

                        <div class="col-md-2">
                            <a href='{{$refrendo->acta_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="form-label col-form-label col-md-3">Representante Legal</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" value="{{$refrendo->representante_refrendo}}"  readonly/>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <label class="form-label col-form-label col-md-3">Domicilio</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" value="{{$refrendo->domicilio_texto_refrendo}}"  readonly/>
                        </div>

                    </div>

                    <div class="row mb-3">
                        <label class="form-label col-form-label col-md-3">Comprobante de Domicilio</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" value="{{$refrendo->domicilio_refrendo}}"  readonly/>
                        </div>

                        <div class="col-md-2">
                            <a href='{{$refrendo->domicilio_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="form-label col-form-label col-md-3">Página Web del Contratista</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" value="{{$refrendo->pagina_refrendo}}"  readonly/>
                        </div>

                        <div class="col-md-2">
                            <a href='{{$refrendo->pagina_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="form-label col-form-label col-md-3">Constancia de Capacitación</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" value="{{$refrendo->constancia_refrendo}}"  readonly/>
                        </div>

                        <div class="col-md-2">
                            <a href='{{$refrendo->constancia_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="form-label col-form-label col-md-3">Documento de Estratificación</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" value="{{$refrendo->estratificacion_refrendo}}"  readonly/>
                        </div>

                        <div class="col-md-2">
                            <a href='{{$refrendo->estratificacion_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="form-label col-form-label col-md-3">Declaración Fiscal</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" value="{{$refrendo->declaracion_refrendo}}"  readonly/>
                        </div>

                        <div class="col-md-2">
                            <a href='{{$refrendo->declaracion_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="form-label col-form-label col-md-3">Facturas de Maquinaria y Equipo</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" value="{{$refrendo->maquinaria_refrendo}}"  readonly/>
                        </div>

                        <div class="col-md-2">
                            <a href='{{$refrendo->maquinaria_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                        </div>
                    </div>


                    <br />
                    <div class="row">
                        <div class="d-flex">
                            <h4>Notas para la revisión del Refrendo 2023:</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="nota_refrendo" id="editorNotaRefrendo">
                                {{ $refrendo->nota_refrendo }}
                            </textarea>

                                        <script>
                                                window.addEventListener("load", (e)=>{
                                                    ClassicEditor.create( document.querySelector('#editorNotaRefrendo' ),{
                                                    } )
                                                    .then(editor => {
                                                        editor.isReadOnly; // `false`.
                                                            editor.enableReadOnlyMode( '#editorRefrendo' );
                                                            const toolbarElement = editor.ui.view.toolbar.element;
                                                            toolbarElement.style.display = 'none';
                                                    } ) .catch( error => {
                                                        console.error( error );
                                                    } );
                                                });
                                        </script>

                        </div>
                    </div>

                    <br />
                    <br />

                    <div class="row mb-12">
                        <label class="form-label col-form-label text-center col-md-12"><h3>Especialidades</h3></label>
                    </div>

                        @foreach ( $refrendo->empresa->especialidades as $especialidad)

                            <div class="row mb-3">
                                <label class="form-label col-form-label col-md-4">{{  $especialidad->especialidad->nombre }}</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control"  value="{{ $especialidad->link_especialidad }}" readonly />
                                </div>
                                <div class="col-md-1">
                                    <span class="badge bg-primary">{{ $especialidad->ejercicio }}</span>
                                </div>
                                <div class="col-md-2">
                                    <a href='{{$especialidad->link_especialidad}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                                </div>
                            </div>

                        @endforeach

                    <br />
                    <br />

                    <div class="row">
                        <div class="d-flex">
                            <h3> Observaciones de Contraloría:</h3>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <textarea name="contraloria" id="editorContraloria" placeholder="{{ isset($refrendo->observacionesRefrendos->contraloria)? '' : 'No se ha hecho alguna Observación' }}">

                                {{isset($refrendo->observacionesRefrendos->contraloria) ? $refrendo->observacionesRefrendos->contraloria : 'Contraloría no ha hecho observaciones.' }}

                            </textarea>
                                        <script>
                                                window.addEventListener("load", (e)=>{
                                                    ClassicEditor.create( document.querySelector('#editorContraloria' ),{
                                                    } )
                                                    .then(editor => {
                                                        editor.isReadOnly; // `false`.
                                                            editor.enableReadOnlyMode( '#editorContraloria' );
                                                            const toolbarElement = editor.ui.view.toolbar.element;
                                                            toolbarElement.style.display = 'none';
                                                    } ) .catch( error => {
                                                        console.error( error );
                                                    } );
                                                });
                                        </script>
                        </div>
                    </div>

                    <br />
                    <br />


                    <form method="POST" action="{{ route('revisor.refrendo.observaciones') }}" autocomplete="off" id="formEnviar">
                        @csrf
                        <input type="hidden" class="form-control" id="empresa_id" name="empresa_id" value="{{ $refrendo->empresa->id }}" readonly />
                        <input type="hidden" class="form-control" id="obras_id" name="obras_id" value="{{ auth()->user()->id }}" readonly />
                        <input type="hidden" class="form-control" id="refrendo_id" name="refrendo_id" value="{{ $refrendo->id }}" readonly />
                        <div class="row">
                            <div class="d-flex">
                                <h3>{{ isset($refrendo->observacionesRefrendos->obras_id) ? 'Observaciones realizadas por '.$refrendo->observacionesRefrendos->revisor->name : 'El Área de Padrón no ha realizado una Observación' }} :</h3>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="obras" id="editor" placeholder="{{ isset($refrendo->observacionesRefrendos->obras)? '' : 'No ha hecho alguna Observación' }}">

                                    {{isset($refrendo->observacionesRefrendos->obras) ? $refrendo->observacionesRefrendos->obras : 'No se han hecho observaciones.' }}

                                </textarea>
                                @if ($refrendo->estatus == 'O' || $refrendo->estatus == 'V')
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

                                @else
                                            <script>
                                                window.addEventListener("load", (e)=>{
                                                    ClassicEditor.create( document.querySelector('#editor' ),{
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
                                @endif
                            </div>
                        </div>

                        @if ($refrendo->estatus == 'O' || $refrendo->estatus == 'V')

                        @else
                            <div class="row" style="margin-top: 15px;">
                                <div class="d-flex justify-content-end">
                                    <button type="button" id="validar" class="btn btn-blue w-100px">Validar</button>&nbsp;
                                    <button type="submit" id="enviar" class="btn btn-red w-100px">Enviar</button>
                                </div>
                            </div>

                        @endif

                    </form>

                </div>
                <!-- END panel -->
            </div>
        </div>
        <!-- END col-12 -->
    </div>
    <!-- END row -->



@endsection
