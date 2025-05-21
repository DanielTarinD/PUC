<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Capital Contable</label>
    <div class="col-md-9">
        <input type="text" class="form-control"  value="{{ $empresa->contables->capital_contable }}" readonly/>
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Capital Contable del Balance General(Nueva Empresa)*</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->contables->balance_contable }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Nombre de quien emitio el Balance General</label>
    <div class="col-md-9">
        <input type="text" class="form-control"  value="{{$empresa->contables->nombre_contador }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Fecha en la que se expidio el Balance General</label>
    <div class="col-md-9">
        <input type="text" class="form-control"  value="{{ $empresa->contables->fecha_balance_general }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Folio de Opinión de cumplimiento de la 32D</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ old('folio_opinion') }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Link a la Declaración Fiscal <i class="fas fa-circle-info" data-toggle="tooltip" title='Del ejercicio inmediato anterior y Opinión de cumplimiento positiva. En el caso de que su declaración fiscal no presente el anexo donde se refleje el estado de su situación financiera, o que este reportada en ceros, así como las empresas de nueva creación que aun no presentan declaración fiscal, deberán anexar un balance general, avalado por un Contador Público Registrado o Certificado.'></i></label>
    <div class="col-md-7">
        <input type="text" class="form-control" value="{{$empresa->contables->link_declaracion}}" readonly/>
    </div>
    <div class="col-md-2">
        <a href='{{$empresa->contables->link_declaracion}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
    </div>
</div>
