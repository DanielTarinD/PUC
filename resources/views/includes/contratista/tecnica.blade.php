<form method="POST" action="{{ route('empresa.tecnica.store') }}" autocomplete="off" id="formInformacionTecnica">
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
        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Nombre del Representante Técnico</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="nombre_representante" value="{{ old('nombre_representante') }}" placeholder="Nombre del Representante Técnico"/>
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Número de Cedula del Representante Técnico</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="cedula_representante" value="{{ old('cedula_representante') }}" placeholder="Número de Cedula del Representante Técnico" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Link al documento de Aceptación de Representante Técnico <i class="fas fa-circle-info" data-toggle="tooltip" title='Escrito de aceptación del Representante Técnico (Oficio elaborado y firmado por el Representante Técnico, NO por la empresa), con los datos básicos de la persona, anexando copia de la cédula profesional del mismo'></i></label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="link_aceptacion" value="{{ old('link_aceptacion') }}" placeholder="Link al documento de Aceptación de Representante Técnico" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Link a los documentos que avalan posesión de Maquinaria y Equipo en la Empresa <i class="fas fa-circle-info" data-toggle="tooltip" title='Expedidas a nombre de la persona física o moral, de maquinaria y/o equipo (para obras públicas o proyectos), Debera contar con un mínimo de maquinaria y/o equipo de su propiedad, (Revolvedora y Vibrador). En caso de arrendamiento de la maquinaria y equipo, se deberá presentar contrato de comodato. *Presentar Original para cotejar.'></i></label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="anexo_maquinaria" value="{{ old('anexo_maquinaria') }}" placeholder="Link a las Facturas y/o Contratos" />
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary w-100px">Guardar</button>
            </div>
        </div>
    </fieldset>
</form>
