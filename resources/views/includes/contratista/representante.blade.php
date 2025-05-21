<form method="POST" action="{{ route('empresa.representante.store') }}" autocomplete="off" id="formInformacionRepresentante">
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
            <label class="form-label col-form-label col-md-3">Nombre del Administrador/Representante Legal</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="nombre_representante" value="{{ old('nombre_representante') }}" placeholder="Nombre del Administrador/Representante Legal" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Número de la Escritura Pública en la que se Otorga el Poder</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="numero_poder" value="{{ old('numero_poder') }}" placeholder="Número de la Escritura Pública en la que se Otorga el Poder" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Fecha de la Escritura Pública en la que se Otorga el Poder</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="fecha_poder" id="datepicker-fechaPoder" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Estado de Expedición del Poder</label>
            <div class="col-md-9">
                <select class="form-select" name="estado_expedicion" id="estado_expedicion">
                    <option value="" disabled selected>Seleccione un Estado</option>

                    @foreach ($estados as $estado)
                    <option value="{{ $estado->id }}">
                        {{ $estado->nombre }}
                    </option>
                    @endforeach

                </select>

            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Ciudad de Expedición del Poder</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="ciudad_expedicion" value="{{ old('ciudad_expedicion') }}" placeholder="Ciudad de Expedición del Poder" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Nombre del Notario Público que dio Fe de la Escritura</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="nombre_notario" value="{{ old('nombre_notario') }}" placeholder="Nombre del Notario Público que dio Fe de la Escritura" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Número del Notario Público que dio Fe de la Escritura</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="numero_notario" value="{{ old('numero_notario') }}" placeholder="Número del Notario Público que dio Fe de la Escritura" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Nombre del Corredor Público que dio Fe de la Escritura</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="nombre_corredor" value="{{ old('nombre_corredor') }}" placeholder="Nombre del Corredor Público que dio Fe de la Escritura" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Número del Corredor Público que dio Fe de la Escritura</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="numero_corredor" value="{{ old('numero_corredor') }}" placeholder="Número del Corredor Público que dio Fe de la Escritura" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Estado Sede del Notario/Corredor Público</label>
            <div class="col-md-9">
                <select class="form-select" name="estado_corredor" id="estado_corredor">
                    <option value="" disabled selected>Seleccione un Estado</option>

                    @foreach ($estados as $estado)
                    <option value="{{ $estado->id }}">
                        {{ $estado->nombre }}
                    </option>
                    @endforeach

                </select>

            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Ciudad Sede del Notario/Corredor Público</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="ciudad_corredor" value="{{ old('ciudad_corredor') }}" placeholder="Ciudad Sede del Notario/Corredor Público" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Número del Folio Mercantil del Registro Público de la Propiedad</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="numero_mercantil" value="{{ old('numero_mercantil') }}" placeholder="Número del Folio Mercantil del Registro Público de la Propiedad" />
            </div>
        </div>


        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Fecha del Folio Mercantil del Registro Público de la Propiedad</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="fecha_mercantil" id="datepicker-fechaMercantil" />
            </div>
        </div>



        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Estado en que se Formalizo el Registro Público de la Propiedad</label>
            <div class="col-md-9">
                <select class="form-select" name="estado_registro" id="estado_registro">
                    <option value="" disabled selected>Seleccione un Estado</option>

                    @foreach ($estados as $estado)
                    <option value="{{ $estado->id }}">
                        {{ $estado->nombre }}
                    </option>
                    @endforeach

                </select>

            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Ciudad en la que se Formalizo el Registro Público de la Propiedad</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="ciudad_registro" value="{{ old('ciudad_registro') }}" placeholder="Ciudad en la que se Formalizo el Registro Público de la Propiedad" />
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary w-100px">Guardar</button>
            </div>
        </div>
    </fieldset>
</form>
