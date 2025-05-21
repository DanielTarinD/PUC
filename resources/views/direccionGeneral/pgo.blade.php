@extends('layouts.app')

@section('title', 'PGO')

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

	var table = $('#dataTableObras').DataTable({
                ajax: "{{ route('obras.list') }}",
                serverSide: true,
                processing: true,
                columns: [
					{data: 'pgo', name: 'pgo'},
					{data: 'cct', name: 'cct'},
					{data: 'nombre', name: 'nombre'},
					{data: 'modalidad_contratacion.nombre', name: 'modalidadContratacion.nombre'},
                    {data: 'monto_original', name: 'monto_original'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.11.1/i18n/es-mx.json'
                },
                columnDefs: [
					{
						targets: 4,
						className: 'dt-body-right'
					},
					{
						targets: 5,
						className: 'dt-body-center'
					}
                ],

                buttons: [
                    { extend: 'excel', className: 'btn-sm', exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                    { extend: 'pdf', className: 'btn-sm', orientation: 'vertical', exportOptions: {
                            columns: [ 0, 1, 2, 3, 4 ]
                        }
                    },
                ],
                dom: '<"row"<"col-sm-4"B><"col-sm-3"l><"col-sm-5"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>', //"<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +"<'row'<'col-sm-12'tr>>" +"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                lengthMenu: [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
                pageLength: 25,
            });

			$("body").on("click","#info",function(event){
					event.preventDefault();

                    var id = $(this).data('id');
                    // AJAX request
                    $.ajax({
                        url: '/obras/info/'+id,
                        type: 'get',

                        success: function(response){
                            // Add response in Modal body
                            $('.modal-content').html(response);

                            // Display Modal
                            $('#modalInfoObra').modal('show');
                        }
                    });
            });


			$("body").on("click","#ppto",function(event){
					event.preventDefault();
					var id = $(this).data('id');
					$.ajax({
                        url: '/obras/ppto/original/'+id,
                        type: 'get',

                        success: function(response){
                            // Add response in Modal body
                            $('#modalPresupestoOriginal .modal-content').html(response);

                            // Display Modal
							$('#modalPresupestoOriginal').modal('show');
                        }
                    });

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
									url: "obras/"+id,
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
								swal("ATENCION !!!", "No se realizó ningún cambio.", "info");
							}
						});
			});

			@if ($errors->any())

				swal("Atencion !!!", "Por favor verifique correctamente los datos.", "warning");

			@endif




});
</script>

@endpush

@section('content')

	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item"><a href="/dashboard">Inicio</a></li>

		<li class="breadcrumb-item">Dirección General</li>

		<li class="breadcrumb-item active">PGO</li>
	</ol>
	<!-- END breadcrumb -->


	<!-- BEGIN page-header -->
	<h1 class="page-header">PGO <small>Información General</small></h1>
	<!-- END page-header -->


	<!-- BEGIN row -->

	<div class="row">
		<!-- BEGIN col-12 -->
		<div class="col-xl-12">
			<!-- BEGIN panel -->
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading">
					<h4 class="panel-title">Fuentes</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
				</div>
				<!-- BEGIN panel-body -->
				<div class="panel-body">
					<!-- BEGIN row -->
                    <div class="row">


                        @if ($fuentes->count() > 0)
                            @foreach ($fuentes as $fuente)
                                    <!-- BEGIN col-3 -->
                                    <div class="col-xl-3 col-md-6">
                                        <div class="widget widget-stats bg-teal">
                                            <div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
                                            <div class="stats-content">
                                                <div class="stats-title"><a href="{{ route('fuentes.show', ['fuente' => $fuente->id]) }}" class="stats-title" style="text-decoration: none" >{{ $fuente->nombre }}</a> ( {{ $fuente->ejercicio->ejercicio }})</div>
                                                <div class="stats-number"> {{  number_format($fuente->techo_presupuestal, 2) }}</div>
                                                <div class="stats-progress progress">
                                                    <div class="progress-bar" style="width: {{ ($fuente->comprometido * 100) / $fuente->techo_presupuestal }}%;"></div>
                                                </div>
                                                <div class="stats-desc">{{ ($fuente->comprometido * 100) / $fuente->techo_presupuestal }} % Comprometido</div>
                                                <div class="stats-link">
                                                    <a href="/obras/create" class="btn btn-primary">Nueva Obra <i class="fa fa-arrow-alt-circle-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END col-3 -->
                            @endforeach
                        @else
                            <div class="col-xl-12 col-md-12">
                                No existen Fuentes registradas.
                            </div>
                        @endif






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
					<h4 class="panel-title">Obras</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
					</div>
				</div>
				<!-- BEGIN panel-body -->
				<div class="panel-body">

					<div class="table-responsive">
						<table class="table table-bordered" id="dataTableObras" width="100%" cellspacing="0">
							<colgroup>
								<col style="width: 10%;">
								<col style="width: 10%;">
								<col style="width: 25%;">
								<col style="width: 10%;">
								<col style="width: 10%;">
								<col style="width: 35%;">
							</colgroup>

							<thead>
								<tr>
									<th>PGO</th>
									<th>CCT</th>
									<th style="text-align:center" >Escuela</th>
									<th>Modalidad</th>
									<th>Monto</th>
									<th style="text-align:center">Opciones</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>PGO</th>
									<th>CCT</th>
									<th style="text-align:center" >Escuela</th>
									<th>Modalidad</th>
									<th>Monto</th>
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


	<div class="modal fade" id="modalInfoObra">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

			</div>
		</div>
	</div>

	<div class="modal fade" id="modalPresupestoOriginal">
		<div class="modal-dialog">
			<div class="modal-content">

			</div>
		</div>
	</div>


@endsection
