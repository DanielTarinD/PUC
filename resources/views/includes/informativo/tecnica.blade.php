<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Nombre del Representante Técnico</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->tecnicas->nombre_representante }}" readonly/>
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Número de Cedula del Representante Técnico</label>
    <div class="col-md-9">
        <input type="text" class="form-control"  value="{{ $empresa->tecnicas->cedula_representante }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Link al documento de Aceptación de Representante Técnico <i class="fas fa-circle-info" data-toggle="tooltip" title='Escrito de aceptación del Representante Técnico (Oficio elaborado y firmado por el Representante Técnico, NO por la empresa), con los datos básicos de la persona, anexando copia de la cédula profesional del mismo'></i></label>
    <div class="col-md-7">
        <input type="text" class="form-control" value="{{$empresa->tecnicas->link_aceptacion}}" readonly/>
    </div>
    <div class="col-md-2">
        <a href='{{$empresa->tecnicas->link_aceptacion}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Link a los documentos que avalan posesión de Maquinaria y Equipo en la Empresa <i class="fas fa-circle-info" data-toggle="tooltip" title='Expedidas a nombre de la persona física o moral, de maquinaria y/o equipo (para obras públicas o proyectos), Debera contar con un mínimo de maquinaria y/o equipo de su propiedad, (Revolvedora y Vibrador). En caso de arrendamiento de la maquinaria y equipo, se deberá presentar contrato de comodato. *Presentar Original para cotejar.'></i></label>
    <div class="col-md-7">
        <input type="text" class="form-control" value="{{$empresa->tecnicas->anexo_maquinaria}}" readonly/>
    </div>
    <div class="col-md-2">
        <a href='{{$empresa->tecnicas->anexo_maquinaria}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
    </div>
</div>


<div class="row mb-12">
    <label class="form-label col-form-label text-center col-md-12">Especialidades</label>
</div>

    @foreach ( $empresa->especialidades as $especialidad)

    <div class="row mb-3">
        <label class="form-label col-form-label col-md-3">{{  $especialidad->especialidad->nombre }}</label>
        <div class="col-md-7">
            <input type="text" class="form-control"  value="{{ $especialidad->link_especialidad }}" readonly />
        </div>
        <div class="col-md-2">
            <a href='{{$especialidad->link_especialidad}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
        </div>
    </div>

    @endforeach

