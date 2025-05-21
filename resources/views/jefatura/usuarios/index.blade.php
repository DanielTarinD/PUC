@extends('layouts.app')

@section('title', 'Usuarios')

@push('css')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.css"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('scripts')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
$(function () {

	var table = $('#dataTableUsuarios').DataTable({
                ajax: "{{ route('jefatura.usuarios.list') }}",
                serverSide: true,
                processing: true,
                columns: [
                    {data: 'avatar', name: 'avatar', orderable: false, searchable: false, exportable: false},
                    {data: 'rol', name: 'rol'},
                    {data: 'rfc', name: 'rfc'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'telefono', name: 'telefono'},
                    {data: 'action', name: 'action', orderable: false, searchable: false, exportable: false}
                ],
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.1/i18n/es-mx.json'
                },
                columnDefs: [
					{
						targets: 6,
						className: 'dt-body-center'
					}
                ],

                buttons: [
                    { extend: 'excel', className: 'btn-sm', exportOptions: {
                            columns: [ 1, 2, 3, 4, 5 ]
                        }
                    },
                    { extend: 'pdf', className: 'btn-sm', orientation: 'vertical', exportOptions: {
                            columns: [ 1, 2, 3, 4, 5]
                        }
                    },
                ],
                dom: '<"row"<"col-sm-4"B><"col-sm-3"l><"col-sm-5"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
                pageLength: 25,
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
									url: "usuarios/"+id,
									type: 'DELETE',
									data: {
										"id": id,
										"_token": token,
									},
									success: function (data){
                                        Swal.fire("ATENCION !!!", data, "info")
										.then((value) => {
												location.reload();
										});
									}
								});
                        }else {
                                Swal.fire("ATENCION !!!", "No se realizó ningún cambio.", "info");
						}
                });

			});

            $("body").on("click","#habilitar",function(event){
				event.preventDefault();
				var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");



                Swal.fire({
                        title: 'ATENCIÓN !!!',
                        text: "Cambiara el Estatus del Usuario.",
                        icon: 'warning',
                        showCancelButton: true,
                        reverseButtons: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Cambiar'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax(
								{
									url: "usuarios/status/"+id,
									type: 'GET',
									data: {
										"id": id,
										"_token": token,
									},
									success: function (data){
                                        Swal.fire(data, "", "info")
										.then((value) => {
												location.reload();
										});
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
		<li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>

		<li class="breadcrumb-item active">Usuarios</li>
	</ol>
	<!-- END breadcrumb -->


	<!-- BEGIN page-header -->
	<h1 class="page-header">Usuarios <small></small></h1>
	<!-- END page-header -->


	<!-- BEGIN row -->

	<div class="row">
		<!-- BEGIN col-12 -->
		<div class="col-xl-12">
			<!-- BEGIN panel -->
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<h4 class="panel-title">Información General</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
				</div>
				<!-- BEGIN panel-body -->
				<div class="panel-body">
					<div class="row">
						<!-- BEGIN col-3 -->
						<div class="col-xl-3 col-md-6">
							<div class="widget widget-stats bg-teal">
								<div class="stats-icon stats-icon-lg"><i class="fa fa-user"></i></div>
								<div class="stats-content">
									<div class="stats-title">Total</div>
									<div class="stats-number">{{ $usuarios_totales}}</div>
									<div class="stats-link">
										<a href="/registro" class="btn btn-primary">Nuevo <i class="fa fa-arrow-alt-circle-right"></i></a>
									</div>
								</div>
							</div>
						</div>
						<!-- END col-3 -->
					</div>
					<!-- END row -->



				</div>
				<!-- END panel-body -->
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
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<h4 class="panel-title">Listado</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
				</div>
				<!-- BEGIN panel-body -->
				<div class="panel-body">

					<div class="table-responsive">
						<table class="table table-bordered" id="dataTableUsuarios" width="100%" cellspacing="0">
							<colgroup>
                                <col style="width: 5%;">
								<col style="width: 10%;">
                                <col style="width: 10%;">
								<col style="width: 25%;">
								<col style="width: 20%;">
                                <col style="width: 10%;">
                                <col style="width: 20%;">
							</colgroup>

							<thead>
								<tr>
                                    <th style="align:center">#</th>
                                    <th>Rol</th>
                                    <th>RFC</th>
									<th>Nombre</th>
                                    <th>Correo Electrónico</th>
                                    <th>Teléfono</th>
									<th style="text-align:center">Opciones</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
                                    <th style="align:center">#</th>
                                    <th>Rol</th>
                                    <th>RFC</th>
									<th>Nombre</th>
                                    <th>Correo Electrónico</th>
                                    <th>Teléfono</th>
									<th style="text-align:center">Opciones</th>
								</tr>
							</tfoot>
						</table>
					</div>



				</div>
				<!-- END panel-body -->
			</div>
			<!-- END panel -->
		</div>
		<!-- END col-12 -->
	</div>
	<!-- END row -->


@endsection
