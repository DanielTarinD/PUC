@extends('layouts.app')

@section('title', 'Inicio')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.css"/>

<style>
.sdupot-color {
    background-color: #ab0033;
}
</style>
@endpush

@push('scripts')
<script src='{{ asset('assets/plugins/ckeditor5/ckeditor.js') }}'></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

$(function () {
    $('[data-toggle="tooltip"]').tooltip();



    Swal.fire({
        icon: 'info',
        confirmButtonText: 'Enterado',
        title: 'ATENCIÓN !!!',
        text: 'A continuación se presentan los datos requeridos para el refrendo 2025-2026, por favor actualice los que usted crea necesarios.',
        footer: 'Da click &nbsp;<a href="{{ asset("/assets/R2025.pdf") }}" target="_blank"> aqui </a> &nbsp; para conocer mas sobre los requisitos. '
    });


});




$(function () {

            $(".form-select").select2({
                    width: 'resolve',
                    sorter: function(data) {
                        return data.sort(function (a, b) {
                            if (a.text > b.text) {
                                return 1;
                            }
                            if (a.text < b.text) {
                                return -1;
                            }
                            return 0;
                        });
                    }
            });

            $("body").on("change","#estado_id",function(event){
                $('#municipio_id').html('');
                    $.ajax({
                        url: "/api/fetch-municipios",
                        type: "POST",
                        data:{
                            estado_id: this.value,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function (data){
                            $('#municipio_id').html('<option value="">Selecciona un Municipio</option>');
                                $.each(data.municipios, function (key, value){
                                    $('#municipio_id').append('<option value="' + value.id + '">' + value.nombre + '</option>');
                                });
                        }
                    });

            });


            $("body").on("change","#municipio_id",function(event){
                $('#localidad_id').html('');
                    $.ajax({
                        url: "/api/fetch-localidades",
                        type: "POST",
                        data:{
                            municipio_id: this.value,
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'json',
                        success: function (data){
                            $('#localidad_id').html('<option value="">Selecciona una Localidad</option>');
                                $.each(data.localidades, function (key, value){
                                    $('#localidad_id').append('<option value="' + value.id + '">' + value.nombre + '</option>');
                                });
                        }
                    });

            });

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
					},
                    {
						targets: 3,
						className: 'dt-body-center'
					}
                ],
                pageLength: 25,
            });


            $("#formInformacionEspecialidades").submit(function (event) {

                $.ajax({
                    url: "/empresa/refrendo/especialidades",
                    type: "POST",
                    data:{
                        empresa_id: $("#empresa_id").val(),
                        especialidad_id: $("#especialidad_id").val(),
                        link_especialidad: $("#link_especialidad").val(),
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success:function(response)
                    {
                        console.log(response.message);
                        table.ajax.reload(null, false);
                    },
                    error: function (xhr) {
                        $.each(xhr.responseJSON.errors, function(key,value) {
                            alert(value);
                        });
                        table.ajax.reload(null, false);
                    },
                });
                $('#formInformacionEspecialidades').trigger("reset");
                $(".form-select").val('').trigger('change')
                event.preventDefault();
            });


            $("body").on("click","#borrar",function(event){
				event.preventDefault();
				var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");

                Swal.fire({
                        title: 'ATENCIÓN !!!',
                        text: "Esta acción no se puede deshacer.",
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
									url: "/empresa/refrendo/especialidades",
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


            $('#formRefrendo').on('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                title: 'ATENCION !!!',
                text: "Antes de enviar la información para revisión asegúrese de actualizar sus ESPECIALIDADES.",
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-outline-danger ml-1'
                },
                buttonsStyling: false
                }).then(function(result) {
                if (result.value) {
                    Swal.fire({
                    icon: 'success',
                    title: 'Enviado',
                    text: '',
                    customClass: {
                        confirmButton: 'btn btn-success'
                    }
                    });
                    setTimeout(function() { $('#formRefrendo')[0].submit() },1000);
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
	<h1 class="page-header">Refrendo </h1>
	<!-- END page-header -->

    @if (isset($empresa))
        @if ($empresa->estatus == "R" || $empresa->estatus == "O")
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
        @elseif($empresa->estatus == "V")
                <!-- BEGIN row -->
                <div class="row">
                    <!-- BEGIN col-3 -->
                    <div class="col-xl-12 col-md-6">
                        <div class="widget widget-stats sdupot-color">
                            <div class="stats-icon"><i class="fas fa-building"></i></div>
                            <div class="stats-info">
                                <p>
                                    {{ $empresa->tipo == "1" ? $empresa->nombre_empresa : $empresa->nombre_persona }} - Refrendo
                                </p>

                                <p></p>
                                <h5>{{ $empresa->rfc_empresa }}</h5>
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
                            <p>
                                {{ $empresa->tipo == "1" ? $empresa->nombre_empresa : $empresa->nombre_persona }}
                            </p>

                            <p></p>
                            <h5>{{ $empresa->rfc_empresa }}</h5>
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
                <h4 class="panel-title">Datos necesarios para el refrendo 2025 - 2026</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">

                <form method="POST" action="{{ route('empresa.refrendo.store') }}" autocomplete="off" id="formRefrendo">
                    @csrf
                    <fieldset>
                        <input type="hidden" class="form-control" name="empresa_id" value="{{ $empresa->id }}" readonly />
                        <input type="hidden" class="form-control" name="ejercicio" value="2025" readonly />


                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Solicitud de Refrendo. <i class="fas fa-circle-info" data-toggle="tooltip" title='Escrito dirigido a la C. Arq. Urb. Irene Jiménez Montiel, titular de la Secretaría de Desarrollo Urbano, Obras Públicas y Ordenamiento Territorial, solicitando su Refrendo al Padrón Único de Contratistas e indicando las especialidades, que la persona física o moral requiera, según su experiencia comprobable. Agregar al final del escrito la leyenda: "Manifiesto bajo protesta de decir verdad que los documentos e información proporcionada son fidedignos y veraces"'></i>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="solicitud_refrendo" value="{{ old('solicitud_refrendo') }}"  placeholder="Enlace a la Solicitud de Refrendo"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Acta Constitutiva. <i class="fas fa-circle-info" data-toggle="tooltip" title='Anexar Copia del acta(s) modificatoria(s) al Acta Constitutiva debidamente inscrita en el Registro Público de la Propiedad.'></i></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="acta_refrendo" value="{{ old('acta_refrendo') }}"  placeholder="Enlace al Acta Constitutiva. (En caso de que exista algún cambio de Administración en la Empresa Moral)"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Representante Legal. <i class="fas fa-circle-info" data-toggle="tooltip" title='En caso de haber cambiado.'></i></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="representante_refrendo" value="{{ old('representante_refrendo') }}"  placeholder="Solo en caso de haber cambiado el representante legal, deberán anotar el nombre del nuevo representante (texto)."/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Comprobante de Domicilio. <i class="fas fa-circle-info" data-toggle="tooltip" title='3.1 - Escrito dirigido al titular de la SDUOPOT, en el que se manifieste el domicilio de la empresa, así como mencionar los datos de contacto:
                                Números telefónicos y correo electrónico de la misma. *Agregar al final del escrito la leyenda: "Manifiesto bajo protesta de decir verdad que los documentos e información proporcionada son fidedignos y veraces". 3.2 - Comprobante actualizado del mismo, con antigüedad menor a tres meses a nombre de la empresa moral o en caso de Persona física, a nombre del Representante Legal (De lo contrario anexar una Carta de Arrendamiento vigente). 3.3 - Macro localización (Croquis de la ubicación del mismo), Micro localización (Fotografías de la fachada del domicilio).'></i>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="domicilio_refrendo" value="{{ old('domicilio_refrendo') }}"  placeholder="Enlace al Comprobante de Domicilio. (En caso de que exista un cambio de Domicilio para oír y recibir notificaciones)."/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <label class="form-label col-form-label col-md-2">Estado</label>
                            <div class="col-md-9">
                                <select class="form-select" name="estado_id" id="estado_id">
                                    <option value="" disabled selected>Seleccione un Estado</option>

                                    @foreach ($estados as $estado)
                                    <option value="{{ $estado->id }}">
                                        {{ $estado->nombre }}
                                    </option>
                                    @endforeach

                                </select>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <label class="form-label col-form-label col-md-2">Municipio</label>
                            <div class="col-md-9">
                                <select class="form-select" name="municipio_id" id="municipio_id">

                                </select>

                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <label class="form-label col-form-label col-md-2">Localidad</label>
                            <div class="col-md-9">
                                <select class="form-select" name="localidad_id" id="localidad_id">

                                </select>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <label class="form-label col-form-label col-md-2">Colonia</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="colonia" value="{{ old('colonia') }}" placeholder="Colonia" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <label class="form-label col-form-label col-md-2">Domicilio</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="domicilio_texto_refrendo" value="{{ old('domicilio_texto_refrendo') }}" placeholder="Calle y Número" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-1"></div>
                            <label class="form-label col-form-label col-md-2">Código Postal</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="codigo_postal" value="{{ old('codigo_postal') }}" placeholder="Código Postal" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Página web del contratista. <i class="fas fa-circle-info" data-toggle="tooltip" title='Enlace de una página web oficial en donde aparezca el nombre de su empresa, su giro comercial y contacto.'></i>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="pagina_refrendo" value="{{ old('pagina_refrendo') }}"  placeholder="Enlace a la Página web del contratista"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Constancia de capacitación. <i class="fas fa-circle-info" data-toggle="tooltip" title='Actualizada al año en curso, emitida por las instituciones autorizadas por la Ley de Obras Públicas y sus Servicios del Estado de Guerrero, artículo 31 Fracción X.'></i>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="constancia_refrendo" value="{{ old('constancia_refrendo') }}"  placeholder="Enlace a la Constancia de capacitación"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Documento de estratificación.
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="estratificacion_refrendo" value="{{ old('estratificacion_refrendo') }}"  placeholder="Enlace al Documento de estratificación"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Declaración fiscal. <i class="fas fa-circle-info" data-toggle="tooltip" title='Del ejercicio inmediato anterior y Opinión de cumplimiento positiva del SAT 32-D.  Anexo del Estado de Situación financiera ante el Servicio de Administración Tributaria'></i>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="declaracion_refrendo" value="{{ old('declaracion_refrendo') }}"  placeholder="Enlace a la Declaración fiscal"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Facturas de maquinaria y equipo. <i class="fas fa-circle-info" data-toggle="tooltip" title='Anexar Contrato Completo junto a su respectiva Acta de Entrega, en donde acredite la experiencia con obras similares a las especialidades que solicita.
                                *Un Contrato mínimo por cada especialidad solicitada. * Vease Anexo Catalogo de Especialidades'></i>
                            </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="maquinaria_refrendo" value="{{ old('maquinaria_refrendo') }}"  placeholder="Enlace a las Facturas de maquinaria y equipo"/>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="d-flex">
                                <h4>Notas para la revisión:</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="nota_refrendo" id="nota_refrendo">
                                    {{ old('nota_refrendo') }}
                                </textarea>
                                <script>
                                    window.addEventListener("load", (e)=>{

                                            ClassicEditor.create( document.querySelector( '#nota_refrendo' ),{

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
                        <br />

                        <div class="row">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-red w-100px">Guardar</button>
                            </div>
                        </div>

                    </fieldset>
                </form>

                <br />
                <br />

                <div class="row g-3">
                    <div class="col-sm-12">
                        <h3>Agregar especialidades nuevas.</h3>
                    </div>
                </div>

                <br />


                <form method="POST" action="{{ route('empresa.especialidades.store') }}" autocomplete="off" id="formInformacionEspecialidades">
                    @csrf
                    <input type="hidden" name="empresa_id" id="empresa_id" value="{{ $empresa->id }}" readonly>
                    <div class="row g-3">
                        <div class="col-sm-5">
                            <select class="form-select" name="especialidad_id" id="especialidad_id">
                                <option value="" disabled selected>Seleccione una Especialidad</option>

                                @foreach ($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}">
                                    {{ $especialidad->nombre }}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="link_especialidad" id="link_especialidad" placeholder="Link al documento que acredite la experiencia">
                        </div>
                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-red ">Agregar</button>
                        </div>
                    </div>
                </form>
                <br />
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableEspecialidades" width="100%" cellspacing="0">
                            <colgroup>
                                <col style="width: 45%;">
                                <col style="width: 25%;">
                                <col style="width: 10%;">
                                <col style="width: 20%;">
                            </colgroup>

                            <thead>
                                <tr>
                                    <th>Especialidad</th>
                                    <th style="text-align:center">Link</th>
                                    <th style="text-align:center">Refrendo</th>
                                    <th style="text-align:center">Opciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Especialidad</th>
                                    <th style="text-align:center">Link</th>
                                    <th style="text-align:center">Refrendo</th>
                                    <th style="text-align:center">Opciones</th>
                                </tr>
                            </tfoot>
                        </table>
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
