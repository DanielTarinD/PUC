<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Número de Folio de la Escritura Pública</label>
    <div class="col-md-9">
        <input type="text" class="form-control"  value="{{ $empresa->legales->folio_escritura }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Fecha de la Escritura Pública</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->legales->fecha_escritura }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Estado</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->legales->estadoExpedicion->nombre }}" readonly />
    </div>
</div>


<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Ciudad de Expedición de la Escritura</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{  $empresa->legales->ciudad_expedicion }}" readonly />
    </div>
</div>


<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Nombre del Notario/Corredor Público que dio Fe de la Escritura</label>
    <div class="col-md-9">
        <input type="text" class="form-control"  value="{{  $empresa->legales->nombre_notario }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Número del Notario/Corredor Público que dio Fe de la Escritura</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->legales->numero_notario }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Número del Folio Mercantil</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->legales->folio_mercantil }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Fecha del Folio Mercantil</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{  $empresa->legales->fecha_mercantil }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Estado</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->legales->estadoFormalizacion->nombre }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Ciudad en que se Formalizo el Registro Público de la Propiedad</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{  $empresa->legales->ciudad_formalizacion }}" readonly />
    </div>
</div>


<div class="row mb-12">
    <label class="form-label col-form-label text-center col-md-12">Socios</label>
</div>


@foreach ( $empresa->socios as $socio)

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">{{  $socio->rfc_socio }} - {{  $socio->nombre_socio }}</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="$ {{ $socio->monto_acciones  }}" readonly />
    </div>
</div>

@endforeach
