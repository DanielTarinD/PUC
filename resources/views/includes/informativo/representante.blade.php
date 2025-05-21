    <fieldset>
        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Nombre del Administrador/Representante Legal</label>
            <div class="col-md-9">
                <input type="text" class="form-control" value="{{ $empresa->representantes->nombre_representante }}"  readonly/>
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Número de la Escritura Pública en la que se Otorga el Poder</label>
            <div class="col-md-9">
                <input type="text" class="form-control"  value="{{  $empresa->representantes->numero_poder }}"  readonly/>
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Fecha de la Escritura Pública en la que se Otorga el Poder</label>
            <div class="col-md-9">
                <input type="text" class="form-control" value="{{  $empresa->representantes->fecha_poder }}" readonly/>
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Estado de Expedición del Poder</label>
            <div class="col-md-9">
                <input type="text" class="form-control"  value="{{  $empresa->representantes->estadoExpedicion->nombre }}"  readonly/>
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Ciudad de Expedición del Poder</label>
            <div class="col-md-9">
                <input type="text" class="form-control" value="{{  $empresa->representantes->ciudad_expedicion }}"  readonly/>
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Nombre del Notario Público que dio Fe de la Escritura</label>
            <div class="col-md-9">
                <input type="text" class="form-control" value="{{  $empresa->representantes->nombre_notario }}"  readonly/>
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Número del Notario Público que dio Fe de la Escritura</label>
            <div class="col-md-9">
                <input type="text" class="form-control"  value="{{ $empresa->representantes->numero_notario }}" readonly />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Nombre del Corredor Público que dio Fe de la Escritura</label>
            <div class="col-md-9">
                <input type="text" class="form-control"  value="{{  $empresa->representantes->nombre_corredor }}" readonly />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Número del Corredor Público que dio Fe de la Escritura</label>
            <div class="col-md-9">
                <input type="text" class="form-control"  value="{{$empresa->representantes->numero_corredor }}" readonly />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Estado Sede del Notario/Corredor Público</label>
            <div class="col-md-9">
                <input type="text" class="form-control" value="{{$empresa->representantes->estadoCorredor->nombre }}" readonly />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Ciudad Sede del Notario/Corredor Público</label>
            <div class="col-md-9">
                <input type="text" class="form-control"  value="{{$empresa->representantes->ciudad_corredor }}" readonly />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Número del Folio Mercantil del Registro Público de la Propiedad</label>
            <div class="col-md-9">
                <input type="text" class="form-control"  value="{{  $empresa->representantes->numero_mercantil }}" readonly />
            </div>
        </div>


        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Fecha del Folio Mercantil del Registro Público de la Propiedad</label>
            <div class="col-md-9">
                <input type="text" class="form-control"  value="{{ $empresa->representantes->fecha_mercantil }}" readonly />
            </div>
        </div>



        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Estado en que se Formalizo el Registro Público de la Propiedad</label>
            <div class="col-md-9">
                <input type="text" class="form-control"  value="{{$empresa->representantes->estadoRegistro->nombre }}" readonly />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Ciudad en la que se Formalizo el Registro Público de la Propiedad</label>
            <div class="col-md-9">
                <input type="text" class="form-control"  value="{{ $empresa->representantes->ciudad_registro }}" readonly />
            </div>
        </div>
    </fieldset>
