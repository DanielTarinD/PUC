@extends('layouts.app')

@section('title', 'Socios')

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.css"/>
@endpush

@push('scripts')


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script type="text/javascript">
$(function () {



            var table = $('#dataTableSocios').DataTable({
                ajax: "{{ route('socios.list') }}",
                serverSide: true,
                processing: true,
                bFilter: false,
                bLengthChange: false,
                columns: [
                    {data: 'tipo', name: 'tipo'},
                    {data: 'rfc_socio', name: 'rfc_socio'},
                    {data: 'nombre_socio', name: 'nombre_socio'},
                    {data: 'monto_acciones', name: 'monto_acciones'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, exportable: false}
                ],
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.1/i18n/es-mx.json'
                },
                columnDefs: [
                    {
                        className:'dt-body-right',targets: [3],
                        "render": function ( data, type, row ) {
                        return '$ '+data
                        }
                    },
                    {
						targets: 4,
						className: 'dt-body-center'
					}

                ],
                pageLength: 25,
            });

            $("#formInformacionSocios").submit(function (event) {

                $.ajax({
                    url: "/empresa/socios",
                    type: "POST",
                    data:{
                        empresa_id: $("#empresa_id").val(),
                        tipo: $("#tipo").val(),
                        rfc_socio: $("#rfc_socio").val(),
                        nombre_socio: $("#nombre_socio").val(),
                        monto_acciones: $("#monto_acciones").val(),
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
                $('#formInformacionSocios').trigger("reset");
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
									url: "socios",
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
		<li class="breadcrumb-item"><a href="/">Inicio</a></li>
        <li class="breadcrumb-item">Empresa</li>
        <li class="breadcrumb-item active">Socios</li>
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
                <h4 class="panel-title">Informacion General de la Empresa</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">

                <div class="row mb-3">
                    <label class="form-label col-form-label col-md-3">RFC</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" value="{{ $empresa->rfc_empresa }}" placeholder="" readonly/>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="form-label col-form-label col-md-3">Nombre de la Persona Moral o Física</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" value="{{ $empresa->tipo == 1 ? $empresa->nombre_empresa :  $empresa->nombre_persona  }}" placeholder="" readonly/>
                    </div>
                </div>

            </div>
        </div>
        <!-- END panel -->

    </div>
    <!-- END col-12 -->
</div>
<!-- END row -->


<!-- BEGIN row -->
<div class="row">
    <!-- BEGIN col-12 -->
    <div class="col-xl-12">

        <!-- BEGIN panel -->
        <div class="panel panel-inverse" data-sortable-id="index-2">
            <div class="panel-heading">
                <h4 class="panel-title">Formulario PC-1{{  substr($tipoPersona, 0, 1)  }} - Socios</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{ route('empresa.socios.store') }}" autocomplete="off" id="formInformacionSocios">
                    @csrf
                    <input type="hidden" name="empresa_id" id="empresa_id" value="{{ $empresa->id }}" readonly>
                    <div class="row g-3">
                        <div class="col-sm-2">
                            <select class="form-select" name="tipo" id="tipo">
                                <option value="" disabled selected>Seleccione</option>
                                <option value="2">Físico</option>
                                <option value="1">Moral</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="rfc_socio" id="rfc_socio" placeholder="RFC del Socio">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="nombre_socio" id="nombre_socio" placeholder="Nombre completo del Socio">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="monto_acciones" id="monto_acciones" placeholder="Importe de las acciones que posee">
                        </div>
                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-red ">Agregar</button>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableSocios" width="100%" cellspacing="0">
                            <colgroup>
                                <col style="width: 10%;">
                                <col style="width: 10%;">
                                <col style="width: 30%;">
                                <col style="width: 25%;">
                                <col style="width: 25%;">
                            </colgroup>

                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>RFC</th>
                                    <th>Nombre</th>
                                    <th>Importe de las Acciones</th>
                                    <th style="text-align:center">Opciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tipo</th>
                                    <th>RFC</th>
                                    <th>Nombre</th>
                                    <th>Importe de las Acciones</th>
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
