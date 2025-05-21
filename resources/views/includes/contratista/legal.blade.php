<form method="POST" action="{{ route('empresa.legal.store') }}" autocomplete="off" id="formInformacionLegal">
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
            <label class="form-label col-form-label col-md-3">Número de Folio de la Escritura Pública</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="folio_escritura" value="{{ old('folio_escritura') }}"  placeholder="Número de Folio de la Escritura Pública"/>
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Fecha de la Escritura Pública</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="fecha_escritura" value="{{ old('fecha_escritura') }}" id="datepicker-fechaEscritura" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Estado</label>
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
            <label class="form-label col-form-label col-md-3">Ciudad de Expedición de la Escritura</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="ciudad_expedicion" value="{{ old('ciudad_expedicion') }}" placeholder="Ciudad de Expedición de la Escritura" />
            </div>
        </div>


        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Nombre del Notario/Corredor Público que dio Fe de la Escritura</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="nombre_notario" value="{{ old('nombre_notario') }}" placeholder="Nombre del Notario/Corredor Público" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Número del Notario/Corredor Público que dio Fe de la Escritura</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="numero_notario" value="{{ old('numero_notario') }}" placeholder="Número del Notario/Corredor Público" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Número del Folio Mercantil</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="folio_mercantil" value="{{ old('folio_mercantil') }}" placeholder="Número del Folio Mercantil" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Fecha del Folio Mercantil</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="fecha_mercantil" value="{{ old('fecha_mercantil') }}" id="datepicker-fechaMercantil" />
            </div>
        </div>



        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Estado</label>
            <div class="col-md-9">
                <select class="form-select" name="estado_formalizacion" id="estado_formalizacion">
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
            <label class="form-label col-form-label col-md-3">Ciudad en que se Formalizo el Registro Público de la Propiedad</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="ciudad_formalizacion" value="{{ old('ciudad_formalizacion') }}" placeholder="Ciudad en que se Formalizo el Registro Público de la Propiedad" />
            </div>
        </div>

        <div class="row">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary w-100px">Guardar</button>
            </div>
        </div>
    </fieldset>
</form>
