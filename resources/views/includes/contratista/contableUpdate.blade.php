<form method="POST" action="{{ route('empresa.contable.update') }}" autocomplete="off" id="formInformacionContable">
    @csrf
    <fieldset>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <input type="hidden" class="form-control" name="empresa_id" value="{{ $empresa->id }}" readonly />
        <input type="hidden" class="form-control" name="contable_id" value="{{ $empresa->contables->id }}" readonly />
        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Capital Contable <i class="fas fa-circle-info" data-toggle="tooltip" title='Dato de la Declaración Fiscal'></i></label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="capital_contable" value="{{ old('capital_contable', $empresa->contables->capital_contable) }}" placeholder="Capital Contable"/>
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Capital Contable del Balance General(Nueva Empresa)*  <i class="fas fa-circle-info" data-toggle="tooltip" title='Se anotara (en caso de ser empresa nueva registrada en el mismo ejercicio del refrendo) del Balance General avalado por un Contador Público registrado, en caso de no aplicar anotar “N/A'></i></label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="balance_contable" value="{{ old('balance_contable', $empresa->contables->balance_contable) }}" placeholder="Capital Contable del Balance General" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Nombre de quien emitio el Balance General</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="nombre_contador" value="{{ old('nombre_contador', $empresa->contables->nombre_contador) }}" placeholder="Nombre de quien emitio el Balance General" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Fecha en la que se expidio el Balance General</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="fecha_balance_general" value="{{ old('fecha_balance_general',$empresa->contables->fecha_balance_general) }}" id="datepicker-fechaBalance" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Folio de Opinión de cumplimiento de la 32D</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="folio_opinion" value="{{ old('folio_opinion', $empresa->contables->folio_opinion) }}" placeholder="Folio de Opinión de cumplimiento de la 32D" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Link a la Declaración Fiscal <i class="fas fa-circle-info" data-toggle="tooltip" title='Del ejercicio inmediato anterior y Opinión de cumplimiento positiva. En el caso de que su declaración fiscal no presente el anexo donde se refleje el estado de su situación financiera, o que este reportada en ceros, así como las empresas de nueva creación que aun no presentan declaración fiscal, deberán anexar un balance general, avalado por un Contador Público Registrado o Certificado. Anexar tambien Constancia de Cumplimiento 32-D.'></i></label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="link_declaracion" value="{{ old('link_declaracion', $empresa->contables->link_declaracion) }}" placeholder="Link a la Declaración Fiscal" />
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary w-100px">Actualizar</button>
            </div>
        </div>
    </fieldset>
</form>
