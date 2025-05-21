@extends('layouts.app')

@section('title', 'Empresas')

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.css"/>
@endpush

@push('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.js"></script>
<script type="text/javascript">
    $(function () {

            var table = $('#dataTableEmpresas').DataTable({
                ajax: "{{ route('empresas.list') }}",
                serverSide: true,
                processing: true,
                columns: [
                    {data: 'motivo_empresa', name: 'motivo_empresa'},
                    {data: 'tipo', name: 'tipo'},
                    {data: 'rfc_empresa', name: 'rfc_empresa'},
                    {data: 'nombre_empresa', name: 'nombre_empresa'},
                    {data: 'nombre_persona', name: 'nombre_persona'},
                    {data: 'validaciones', name: 'validaciones', orderable: false, searchable: false, exportable: false},
                    {data: 'estatus', name: 'estatus'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, exportable: false}
                ],
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.1/i18n/es-mx.json'
                },
                columnDefs: [
                    {
                        targets: 5,
                        className: 'dt-body-center'
                    },
                    {
                        targets: 6,
                        className: 'dt-body-center'
                    },
                    {
                        targets: 7,
                        className: 'dt-body-center'
                    }
                ],
                buttons: [
                        { extend: 'excel', className: 'btn-sm', exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 6 ]
                            }
                        },
                    ],
                    dom: '<"row"<"col-sm-4"B><"col-sm-3"l><"col-sm-5"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
                    lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
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
	<h1 class="page-header">Dashboard <small>Empresas</small></h1>
	<!-- END page-header -->


	<!-- BEGIN row -->
	<div class="row">
		<!-- BEGIN col-12 -->
		<div class="col-xl-12">

            <!-- BEGIN panel -->
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<h4 class="panel-title">Empresas</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
				</div>
				<div class="panel-body">

                    <div class="row">
                        <div class="col-12 text-center">
                            <span class='badge bg-danger'>&nbsp;</span> Sin Observar - <span class='badge bg-warning'>&nbsp;</span> Observado - <span class='badge bg-success'>&nbsp;</span> Validado
                        </div>
                    </div>
                    <br />

                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableEmpresas" width="100%" cellspacing="0">
                                <colgroup>
                                    <col style="width: 5%;">
                                    <col style="width: 5%;">
                                    <col style="width: 10%;">
                                    <col style="width: 30%;">
                                    <col style="width: 25%;">
                                    <col style="width: 10%;">
                                    <col style="width: 5%;">
                                    <col style="width: 10%;">
                                </colgroup>

                                <thead>
                                    <tr>
                                        <th>Solicitud</th>
                                        <th>Tipo</th>
                                        <th>RFC</th>
                                        <th>Nombre de la Empresa</th>
                                        <th>Nombre de la Persona</th>
                                        <th style="text-align:center">Validaciones</th>
                                        <th style="text-align:center">Estatus</th>
                                        <th style="text-align:center">Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Solicitud</th>
                                        <th>Tipo</th>
                                        <th>RFC</th>
                                        <th>Nombre de la Empresa</th>
                                        <th>Nombre de la Persona</th>
                                        <th style="text-align:center">Validaciones</th>
                                        <th style="text-align:center">Estatus</th>
                                        <th style="text-align:center">Acciones</th>
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
