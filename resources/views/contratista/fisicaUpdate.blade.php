@extends('layouts.app')

@section('title', 'Información General')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.select2 {
    width:100%!important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function () {

        $('[data-toggle="tooltip"]').tooltip();

        $(".form-select").select2({
            width: 'resolve',
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


    });

</script>
@endpush
@section('content')
	<!-- BEGIN breadcrumb -->
	<ol class="breadcrumb float-xl-end">
		<li class="breadcrumb-item"><a href="/">Inicio</a></li>
        <li class="breadcrumb-item">Empresa</li>
        <li class="breadcrumb-item active">Información General</li>
	</ol>
	<!-- END breadcrumb -->
	<!-- BEGIN page-header -->
	<h1 class="page-header">Empresa <small> - Persona Física</small></h1>
	<!-- END page-header -->

<!-- BEGIN row -->
<div class="row">
    <!-- BEGIN col-12 -->
    <div class="col-xl-12">

        <!-- BEGIN panel -->
        <div class="panel panel-inverse" data-sortable-id="index-1">
            <div class="panel-heading">
                <h4 class="panel-title">Formulario PC-1F - Información General</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">
                @include('includes.contratista.fisicaUpdate')
            </div>
        </div>
        <!-- END panel -->

    </div>
    <!-- END col-12 -->
</div>
<!-- END row -->


@endsection
