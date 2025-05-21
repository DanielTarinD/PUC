@extends('layouts.app')

@section('title', 'Modalidades')

@push('css')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.css"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<style>

	</style>
@endpush

@push('scripts')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.11.1/af-2.3.7/b-2.0.0/b-colvis-2.0.0/b-html5-2.0.0/b-print-2.0.0/cr-1.5.4/date-1.1.1/fc-3.3.3/fh-3.1.9/kt-2.6.4/r-2.2.9/rg-1.1.3/rr-1.2.8/sc-2.0.5/sb-1.2.1/sp-1.4.0/sl-1.3.3/datatables.min.js"></script>
<script src="../assets/plugins/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
$(function () {

	var table = $('#dataTableModalidades').DataTable({
                ajax: "{{ route('modalidades.list') }}",
                serverSide: true,
                processing: true,
                columns: [
					{data: 'nombre', name: 'nombre'},
					{data: 'descripcion', name: 'descripcion'},
					{data: 'status', name: 'estatus'},
					{data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.1/i18n/es-mx.json'
                },
                columnDefs: [
					{
						targets: 2,
						className: 'dt-body-center'
					},
					{
						targets: 3,
						className: 'dt-body-center'
					}
                ],
				buttons: [
                    { extend: 'excel', className: 'btn-sm', exportOptions: {
                            columns: [ 0, 1]
                        }
                    },
                    { extend: 'pdf', className: 'btn-sm', orientation: 'vertical', exportOptions: {
                            columns: [ 0, 1 ]
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

						swal({
								title: "ATENCION !!!",
								text: "Esta acción no se puede deshacer.",
								icon: "warning",
								buttons: true,
								dangerMode: true,
								buttons: ["Cancelar", "Borrar"],
							})
							.then((willDelete) => {
							if (willDelete) {
								$.ajax(
								{
									url: "modalidades/"+id,
									type: 'DELETE',
									data: {
										"id": id,
										"_token": token,
									},
									success: function (data){
										swal("ATENCION !!!", data, "info")
										.then((value) => {
												location.reload();
										});
									}
								});
							} else {
								swal("No se realizó ningún cambio", "", "info");
							}
						});
			});

            $("body").on("click","#habilitar",function(event){
				event.preventDefault();
				var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");

						swal({
								title: "ATENCION !!!",
								text: "Cambiara el Estatus de la Modalidad",
								icon: "warning",
								buttons: true,
								dangerMode: true,
								buttons: ["Cancelar", "Continuar"],
							})
							.then((willDeact) => {
							if (willDeact) {
								$.ajax(
								{
									url: "modalidades/status/"+id,
									type: 'GET',
									data: {
										"id": id,
										"_token": token,
									},
									success: function (data){
										swal(data, "", "info")
										.then((value) => {
												location.reload();
										});
									}
								});
							} else {
								swal("No se realizó ningún cambio", "", "info");
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

		<li class="breadcrumb-item">Catalogos</li>

		<li class="breadcrumb-item active">Modalidades</li>
	</ol>
	<!-- END breadcrumb -->


	<!-- BEGIN page-header -->
	<h1 class="page-header">Modalidades de Contratación <small>Lista</small></h1>
	<!-- END page-header -->


     <!-- BEGIN row -->
     <div class="row">
        <!-- BEGIN col-12 -->
        <div class="col-xl-12">
            <!-- BEGIN panel -->
            <div class="panel panel-inverse" data-sortable-id="index-1">
                <div class="panel-heading">
                    <h4 class="panel-title">Modalidades de Contratación</h4>
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
                                <div class="stats-icon stats-icon-lg"><i class="fa fa-sort-numeric-down fa-fw"></i></div>
                                <div class="stats-content">
                                    <div class="stats-title">Modalidades de Contratación</div>
                                    <div class="stats-number">{{ $totalModalidades }}</div>
                                    <div class="stats-link">
                                        <a href="/catalogos/modalidades/create" class="btn btn-primary">Nueva Modalidad <i class="fa fa-arrow-alt-circle-right"></i></a>
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
					<h4 class="panel-title">Modalidades de Contratación</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
				</div>
				<!-- BEGIN panel-body -->
				<div class="panel-body">

					<div class="table-responsive">
						<table class="table table-bordered" id="dataTableModalidades" width="100%" cellspacing="0">
							<colgroup>
								<col style="width: 30%;">
								<col style="width: 40%;">
								<col style="width: 10%;">
								<col style="width: 20%;">
							</colgroup>

							<thead>
								<tr>
									<th>Nombre</th>
									<th style="text-align:center" >Descripcion</th>
									<th style="text-align:center" >Estatus</th>
									<th style="text-align:center">Opciones</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Nombre</th>
									<th style="text-align:center" >Descripcion</th>
									<th style="text-align:center" >Estatus</th>
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
