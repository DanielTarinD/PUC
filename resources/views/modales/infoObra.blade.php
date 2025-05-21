
<div class="modal-header">
<h4 class="modal-title">Obra | Datos Generales</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
</div>
<div class="modal-body">
<form action="#" method="#">
<fieldset>
    <div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Número de PGO</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="fuente" placeholder="{{ $obra->pgo }}" disabled/>
    </div>
    </div>

    <div class="row mb-3">
    <label class="form-label col-form-label col-md-3">CCT</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="fuente" placeholder="{{ $obra->cct }}" disabled/>
    </div>
    </div>

    <div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Fuente de Inversión</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="fuente"  placeholder="{{ $obra->fuente->nombre }}" disabled />
    </div>
    </div>

    <div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Modalidad</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="modalidad"  placeholder="{{ $obra->modalidadContratacion->nombre }}" disabled />
    </div>
    </div>

    <div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Acuerdo</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="acuerdo"  placeholder="{{ $obra->acuerdo }}" disabled />
    </div>
    </div>

    <div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Nombre</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="nombre"  placeholder="{{ $obra->nombre }}" disabled />
    </div>
    </div>

    <div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Ubicación</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="localidad"  placeholder="{{ $obra->localidad }}" disabled />
    </div>
    </div>

    <div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Domicilio</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="domicilio"  placeholder="{{ $obra->domicilio }}" disabled />
    </div>
    </div>

    <div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Monto Original</label>
    <div class="col-md-9">
        <input type="text" class="form-control" name="monto_original"  placeholder="$ {{ $obra->monto_original }}" disabled />
    </div>
    </div>

    <div class="row mb-3">
        <label class="form-label col-form-label col-md-3">Anexo Digital</label>
        <div class="col-md-9">
            <a href="{{ $obra->path }}" target="_blank"><i class="fas fa-file-pdf fa-3x"></i> </a>
        </div>
    </div>

</fieldset>
</form>
</div>
<div class="modal-footer">
<a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Cerrar</a>
</div>
