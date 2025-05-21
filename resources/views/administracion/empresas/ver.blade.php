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
                ajax: "{{ route('especialidades.list.administracion', ['id' => $empresa->id]) }}",
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
                <h4 class="panel-title">Información de la Empresa - "{{ $empresa->tipo == '1' ? $empresa->nombre_empresa : $empresa->nombre_persona }}"</h4>
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
                                @include('includes.informativo.tecnicaAdministracion')
                            @endif
                        </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0">
                        <div class="accordion-header" id="headingObservacion">
                        <button class="accordion-button text-white px-3 py-10px pointer-cursor" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObservacion">
                            <i class="fa fa-circle fa-fw {{ $empresa->observaciones()->exists() ? 'text-sduopot' : 'text-red' }} me-2 fs-8px"></i> <b>Observaciones</b>
                        </button>
                        </div>
                        <div id="collapseObservacion" class="accordion-collapse collapse" data-bs-parent="#accordion">
                        <div class="accordion-body bg-white text-black">
                            @if($empresa->observaciones()->exists())
                                @include('includes.informativo.observacionesObras')
                            @endif

                            @if($empresa->observaciones()->exists())
                                @include('includes.informativo.observacionesContraloria')
                            @endif
                        </div>
                        </div>
                    </div>
                    <br /><br />



                    @if ($empresa->folio()->count() > 0)
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('administracion.constancia') }}" autocomplete="off" id="formGenerarConstancia" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="empresa_id" value="{{ $empresa->id }}" readonly />
                            <input type="hidden" name="folio_jefatura" value="{{ substr($empresa->folio->folio_jefatura, 16, -5) }}" readonly/>
                            <input type="hidden" name="fecha_expedicion" value="{{ $empresa->folio->fecha_expedicion }}" readonly />

                            <b>Observaciones de Administración: </b>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea name="observacion" id="editorAdministracion" placeholder="{{ isset($empresa->folio->observacion) ? $empresa->folio->observacion : 'Administración no ha hecho alguna Observación' }}">
                                            {{ isset($empresa->folio->observacion) ? $empresa->folio->observacion : '' }}
                                        </textarea>
                                        <script>
                                                window.addEventListener("load", (e)=>{
                                                    ClassicEditor.create( document.querySelector( '#editorAdministracion' ),{

                                                    } )
                                                    .then( editor => {


                                                    } )
                                                    .catch( error => {
                                                        console.error( error );
                                                    } );
                                                });
                                        </script>
                                    </div>
                                </div>
                                <br /><br />

                                <div class="row mb-3">
                                    <label class="form-label col-form-label col-md-3">Folio de Jefatura </label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{ substr($empresa->folio->folio_jefatura, 16, -5)  }}" readonly />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="form-label col-form-label col-md-3">Fecha de Expedición</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="{{ $empresa->folio->fecha_expedicion }}"  readonly />
                                    </div>
                                </div>

                                @if (isset($empresa->folio->constancia_digitalizada))
                                    <div class="row mb-3">
                                        <label class="form-label col-form-label col-md-3">Constancia Digitalizada</label>
                                        <div class="col-md-9">
                                            <a href='{{ asset('storage/constancias/'.$empresa->folio->constancia_digitalizada) }}' target='_blank' class='btn btn-xs btn-primary w-30px me-1'><i class='fas fa-file-pdf'></i></a>
                                        </div>
                                    </div>
                                @endif

                                <div class="row" style="margin-top: 15px;">
                                    <div class="d-flex justify-content-end">

                                            <button type="submit" id="btnActualizar" class="btn btn-red w-100px">{{ $empresa->folio()->count() > 0 ? 'Actualizar' : 'Generar'  }}</button>

                                    </div>
                                </div>

                            </form>
                    @else
                            <form method="POST" action="{{ route('administracion.constancia') }}" autocomplete="off" id="formGenerarConstancia" enctype="multipart/form-data">
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

                                        <b>Observaciones de Administración: </b>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <textarea name="observacion" id="editorAdministracion" placeholder="{{ isset($empresa->folio->observacion) ? $empresa->folio->observacion : 'Administración no ha hecho alguna Observación' }}">
                                                    {{ isset($empresa->folio->observacion) ? $empresa->folio->observacion : '' }}
                                                </textarea>
                                                <script>
                                                        window.addEventListener("load", (e)=>{
                                                            ClassicEditor.create( document.querySelector( '#editorAdministracion' ),{

                                                            } )
                                                            .then( editor => {

                                                            } )
                                                            .catch( error => {
                                                                console.error( error );
                                                            } );
                                                        });
                                                </script>
                                            </div>
                                        </div>
                                        <br /><br />



                                        <input type="hidden" class="form-control" name="empresa_id" value="{{ $empresa->id }}" readonly />
                                        <div class="row mb-3">
                                            <label class="form-label col-form-label col-md-3">Folio de Jefatura </label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="folio_jefatura" value="{{ old('folio_jefatura', isset($empresa->folio->folio_jefatura)?substr($empresa->folio->folio_jefatura, 16, -5) :'') }}" placeholder="Folio Jefatura"/>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="form-label col-form-label col-md-3">Fecha de Expedición</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="fecha_expedicion" value="{{ old('fecha_expedicion', isset($empresa->folio->fecha_expedicion)?$empresa->folio->fecha_expedicion :'') }}" id="datepicker-fechaExpedicion" />
                                            </div>
                                        </div>

                                        @if($empresa->folio()->count() > 0)
                                            <div class="row mb-3">
                                                <label class="form-label col-form-label col-md-3">Constancia Digitalizada</label>
                                                <div class="col-md-9">
                                                    <input type="file" class="form-control form-control-sm" name="file" >
                                                </div>
                                            </div>
                                        @endif
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="d-flex justify-content-end">

                                                <button type="submit" id="enviar" class="btn btn-red w-100px">{{ $empresa->folio()->count() > 0 ? 'Actualizar' : 'Generar'  }}</button>

                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                    @endif




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
