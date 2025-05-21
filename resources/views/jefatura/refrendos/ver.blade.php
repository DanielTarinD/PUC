@extends('layouts.app')

@section('title', 'Inicio')

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.css"/>
<link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />

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


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.js"></script>

<script src='{{ asset('assets/plugins/ckeditor5/ckeditor.js') }}'></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="/assets/plugins/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js"></script>


<script>
$(function () {

    $('[data-toggle="tooltip"]').tooltip();

    $("#datepicker-fechaExpedicion").datepicker({
        todayHighlight: true,
        autoclose: true,
        language: 'es',
        weekStart: 0,
    });


    $('#enviar').on('click',function(e){
        e.preventDefault();
        var form = $(this).parents('form');
        Swal.fire({
                title: "ATENCION !!!",
                text: "La generación de la Constancia le dara un Identificador Único a la empresa para su validación, esta seguro de desta acción ?",
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

    var table = $('#dataTableEspecialidades').DataTable({
                ajax: "{{ route('especialidades.list.administracion.refrendo', ['id' => $refrendo->empresa->id]) }}",
                serverSide: true,
                processing: true,
                bFilter: false,
                bLengthChange: false,
                columns: [
                    {data: 'especialidad.nombre', name: 'especialidad.nombre'},
                    {data: 'link_especialidad', name: 'link_especialidad'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, exportable: false}
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


    $("body").on("click","#borrar",function(event){
				event.preventDefault();
				var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");

                Swal.fire({
                        title: 'ATENCIÓN !!!',
                        text: "Esta acción requiere antecedentes y no se puede deshacer, esta seguro de eliminar la Especialidad ?",
                        icon: 'warning',
                        showCancelButton: true,
                        reverseButtons: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Borrar'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax(
								{
									url: "/administracion/especialidades",
									type: 'DELETE',
									data: {
										"id": id,
										"_token": token,
									},
									success: function (data){
                                        table.ajax.reload(null, false);
									}
								});
                        }else {
                                Swal.fire("ATENCION !!!", "No se realizó ningún cambio.", "info");
						}
                });

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
                <h4 class="panel-title">Información de la Empresa - "{{ $refrendo->empresa->tipo == '1' ? $refrendo->empresa->nombre_empresa : $refrendo->empresa->nombre_persona }}"</h4>
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
                    <label class="form-label col-form-label text-center col-md-12">Especialidades</label>
                </div>

                <div class="row mb-12">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableEspecialidades" width="100%" cellspacing="0">


                            <thead>
                                <tr>
                                    <th>Especialidad</th>
                                    <th style="text-align:center">Link</th>
                                    <th style="text-align:center">Opciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Especialidad</th>
                                    <th style="text-align:center">Link</th>
                                    <th style="text-align:center">Opciones</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>


                <br />
                <br />

                        <b>Observaciones del Área de Padrón:</b>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="obras" id="editorObras">
                                    {{ isset($refrendo->observacionesRefrendos->obras)? $refrendo->observacionesRefrendos->obras : 'Área de Padrón no ha hecho alguna Observación' }}
                                </textarea>
                                <script>
                                        window.addEventListener("load", (e)=>{
                                            ClassicEditor.create( document.querySelector( '#editorObras' ),{
                                                language: 'es',
                                            } )
                                            .then( editor => {
                                                editor.isReadOnly; // `false`.
                                                                editor.enableReadOnlyMode( '#editorObras' );
                                                                const toolbarElement = editor.ui.view.toolbar.element;
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
                                <textarea name="obras" id="editorContraloriaObservaciones">
                                    {{ isset($refrendo->observacionesRefrendos->contraloria)? $refrendo->observacionesRefrendos->contraloria : 'Contraloría no ha hecho alguna Observación' }}
                                </textarea>
                                <script>
                                    window.addEventListener("load", (e)=>{
                                        ClassicEditor.create( document.querySelector( '#editorContraloriaObservaciones' ),{
                                            language: 'es',
                                        } )
                                        .then( editor => {
                                            editor.isReadOnly; // `false`.
                                                            editor.enableReadOnlyMode( '#editorContraloria' );
                                                            const toolbarElement = editor.ui.view.toolbar.element;
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


                        <b>Observaciones de Administración:</b>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="obras" id="editorAdministracionObservaciones">
                                    {{ isset($refrendo->observacion)? $refrendo->observacion : 'Administración no ha hecho alguna Observación' }}
                                </textarea>
                                <script>
                                    window.addEventListener("load", (e)=>{
                                        ClassicEditor.create( document.querySelector( '#editorAdministracionObservaciones' ),{
                                            language: 'es',
                                        } )
                                        .then( editor => {
                                            editor.isReadOnly; // `false`.
                                                            editor.enableReadOnlyMode( '#editorAdministracionObservaciones' );
                                                            const toolbarElement = editor.ui.view.toolbar.element;
                                                            toolbarElement.style.display = 'none';
                                        } )
                                        .catch( error => {
                                            console.error( error );
                                        } );
                                    });
                            </script>
                            </div>
                        </div>

                <br />
                <br />

                <form method="POST" action="{{ route('jefatura.constancia.refrendo') }}" autocomplete="off" id="formGenerarConstancia" enctype="multipart/form-data">
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


                        <input type="hidden" class="form-control" name="empresa_id" value="{{ $refrendo->empresa->id }}" readonly />
                        <input type="hidden" class="form-control" name="refrendo_id" value="{{ $refrendo->id }}" readonly />


                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Estatus</label>
                            <div class="col-md-9">

                                <select class="form-select" name="estatus" id="estatus">
                                    <option {{ old('estatus', $refrendo->estatus) == 'N' ? 'selected' : '' }} value="N">Nueva</option>
                                    <option {{ old('estatus', $refrendo->estatus) == 'R' ? 'selected' : '' }} value="R">En Revisión</option>
                                    <option {{ old('estatus', $refrendo->estatus) == 'O' ? 'selected' : '' }} value="O">Observada</option>
                                    <option {{ old('estatus', $refrendo->estatus) == 'V' ? 'selected' : '' }} value="V">Validada</option>
                                </select>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Folio de Jefatura </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="folio_jefatura" value="{{ old('folio_jefatura', isset($refrendo->folio_jefatura)?substr($refrendo->folio_jefatura, 16, -5) :'') }}" placeholder="Folio Jefatura"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Fecha de Expedición</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="fecha_expedicion" value="{{ old('fecha_expedicion', isset($refrendo->fecha_expedicion)?$refrendo->fecha_expedicion :'') }}" id="datepicker-fechaExpedicion" />
                            </div>
                        </div>


                        @if(isset($refrendo->folio_jefatura))
                            <div class="row mb-3">
                                <label class="form-label col-form-label col-md-3">Constancia Digitalizada</label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control form-control-sm" name="file" >
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="form-label col-form-label col-md-3">Impreso ?</label>
                                <div class="col-md-9">
                                    <input name="impreso" value="1" class="form-check-input" type="checkbox" {{ isset($refrendo->impreso) ? 'checked' : ''  }} id="impreso" />
                                </div>
                            </div>
                        @endif

                    <div class="row" style="margin-top: 15px;">
                        <div class="d-flex justify-content-end">

                            @if(isset($$refrendo->folio_jefatura))
                                <button type="submit" id="constancia" class="btn btn-blue w-100px">Constancia</button>&nbsp;
                            @endif
                                <button type="submit" id="enviar" class="btn btn-red w-100px">{{ isset($$refrendo->folio_jefatura) ? 'Actualizar' : 'Generar'  }}</button>

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
