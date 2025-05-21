<form method="POST" action="{{ route('empresa.gralMoral.update') }}" autocomplete="off" id="formInformacionGeneral">
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
        <input type="hidden" class="form-control" name="empresa_id" value="{{ $empresa->id}}" readonly />
        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">RFC de la Empresa</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="rfc_empresa" value="{{ auth()->user()->rfc }}" readonly />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Seleccione una Opción</label>
            <div class="col-md-9">
                <select class="form-select" name="motivo_empresa" id="motivo_empresa">
                    <option value="" disabled selected>Seleccione una Opción</option>
                    <option {{ old('motivo_empresa', $empresa->motivo_empresa) == 1 ? 'selected' : '' }}  value="1">Inscripción</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Si es Refrendo, poner el enlace al Registro o Refrendo anterior.</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="enlace_refrendo" value="{{ old('enlace_refrendo', $empresa->enlace_refrendo) }}" placeholder="Enlace al Registro o Refrendo anterior." />
            </div>
        </div>
        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Nombre de la Empresa</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="nombre_empresa" value="{{ old('nombre_empresa', $empresa->nombre_empresa) }}" placeholder="Nombre de la Empresa" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Link a o las Actas <i class="fas fa-circle-info" data-toggle="tooltip" title='Acta Constitutiva debidamente inscrita en el Registro Público de la Propiedad. *Presentar Original para cotejo.'></i></label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="link_acta" value="{{ old('link_acta', $empresa->link_acta) }}" placeholder="Acta Constitutiva debidamente inscrita en el Registro Público de la Propiedad" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Link al Curriculum de la Persona o Empresa <i class="fas fa-circle-info" data-toggle="tooltip" title='De la persona física o moral, incluyendo su organigrama y el curriculum de cada uno del personal que soporte el mismo. - Para las especialidades requeridas se deberá acreditar su experiencia en obras similares mediante Contratos y Actas de Entrega Recepción.'></i></label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="link_cv" value="{{ old('link_cv', $empresa->link_cv) }}" placeholder="Link al Curriculum de la Persona o Empresa" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Estado</label>
            <div class="col-md-9">
                <select class="form-select" name="estado_id" id="estado_id">
                    <option value="{{ $empresa->estado_id }}" selected>{{ $empresa->estado->nombre }}</option>

                    @foreach ($estados as $estado)
                    <option value="{{ $estado->id }}">
                        {{ $estado->nombre }}
                    </option>
                    @endforeach

                </select>

            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Municipio</label>
            <div class="col-md-9">
                <select class="form-select" name="municipio_id" id="municipio_id">
                    <option value="{{ $empresa->municipio_id }}" selected>{{ $empresa->municipio->nombre }}</option>

                </select>

            </div>
        </div>


        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Localidad</label>
            <div class="col-md-9">
                <select class="form-select" name="localidad_id" id="localidad_id">
                    <option value="{{ $empresa->localidad_id }}" selected>{{ $empresa->localidad->nombre }}</option>
                </select>

            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Colonia</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="colonia" value="{{ old('colonia', $empresa->colonia) }}" placeholder="Colonia" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Domicilio</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="domicilio" value="{{ old('domicilio', $empresa->domicilio) }}" placeholder="Calle y Número" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Código Postal</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="codigo_postal" value="{{ old('codigo_postal', $empresa->codigo_postal) }}" placeholder="Código Postal" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Link al escrito que manifieste el domicilio en el Estado <i class="fas fa-circle-info" data-toggle="tooltip" title='Escrito en el que manifieste el domicilio en el Estado de Guerrero para oír y recibir todo tipo de notificación, así como mencionar números telefónicos y correo electrónico de la empresa
                - Comprobante del mismo con antigüedad menor de tres meses a nombre de la empresa o el Representante Legal (De lo contrario anexar Contrato de Arrendamiento)
                - Macro localización (Croquis de la ubicación del mismo), Micro localización (Fotografias de la fachada del domicilio) * Presentar Original para cotejar.'></i></label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="link_domicilio" value="{{ old('link_domicilio', $empresa->link_domicilio) }}" placeholder="Link al escrito que manifieste el domicilio en el Estado" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Link al documento de Domicilio Fiscal <i class="fas fa-circle-info" data-toggle="tooltip" title='DOMICILIO FISCAL: Con respecto a las empresas foráneas, ademas del punto anterior, también se deberán anexar el documento de apertura de sucursal y/o establecimiento en el Estado, expedido por el Servicio de Administración Tributaria, así como el contrato de arrendamiento en su caso.'></i></label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="link_domicilio_fiscal" value="{{ old('link_domicilio_fiscal', $empresa->link_domicilio_fiscal) }}" placeholder="Documento de apertura de sucursal y/o establecimiento en el Estado" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Teléfono del Representante Legal</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="telefono_representante" value="{{ old('telefono_representante', $empresa->telefono_representante) }}" placeholder="Teléfono del Representante Legal" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Teléfono de la Empresa</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="telefono" value="{{ old('telefono', $empresa->telefono) }}" placeholder="Teléfono de la Empresa" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Correo Representante</label>
            <div class="col-md-9">
                <input type="email" class="form-control" name="email_representante" value="{{ old('email_representante', $empresa->email_representante) }}" placeholder="Correo Representante" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Correo de la Empresa</label>
            <div class="col-md-9">
                <input type="email" class="form-control" name="email" value="{{ old('email', $empresa->email) }}" placeholder="Correo de la Empresa" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">URL de la Empresa <i class="fas fa-circle-info" data-toggle="tooltip" title='.  Copia de la presentación física de la página web
                (Captura de pantalla del inicio y enlace de su pagina web en donde aparezca el nombre de su empresa, actividad y contacto de la empresa).'></i></label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="url_empresa" value="{{ old('url_empresa', $empresa->url_empresa) }}" placeholder="URL de la Empresa" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Registro IMSS</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="imss" value="{{ old('imss', $empresa->imss) }}" placeholder="Registro IMSS" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Link al documento del Registro del IMSS <i class="fas fa-circle-info" data-toggle="tooltip" title='REGISTROS. Del IMSS (Aviso de Registro Patronal), con Factor/Prima de Riesgo clase V. - Cédula de Identificación Fiscal (RFC). - Anexar Tarjeta Patronal - *Presentar Original para cotejar.'></i></label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="link_registro" value="{{ old('link_registro', $empresa->link_registro) }}" placeholder="Link al documento del Registro del IMSS" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Folio de Constancia de Capacitación</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="folio_capacitacion" value="{{ old('folio_capacitacion', $empresa->folio_capacitacion) }}" placeholder="Folio/Número de Constancia de Capacitación" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Nombre de quien expide la Constancia de Capacitación</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="nombre_expide" value="{{ old('nombre_expide', $empresa->nombre_expide) }}" placeholder="Nombre de quien Expide la Constancia" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Link a la Constancia de Capacitación <i class="fas fa-circle-info" data-toggle="tooltip" title='CONSTANCIA DE CAPACITACIÓN. Actualizada al año en curso, emitida por las instituciones autorizadas por la Ley de Obras Públicas y sus Servicios del Estado de Guerrero, articulo 31 Fracción X. (La cual puede ser a traves de la, Secretaría del Trabajo, cualquier Institución autorizada por la Secretaría de Educación Pública o la Cámara Mexicana de la Industria de la Construcción). * Presentar Original para cotejar.'></i></label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="link_constancia" value="{{ old('link_constancia', $empresa->link_constancia) }}" placeholder="Link a la Constancia de Capacitación" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Tipo de Estratificación</label>
            <div class="col-md-9">
                <select class="form-select" name="estratificacion" id="estratificacion">
                    <option value="" disabled selected>Seleccione una Opción</option>
                    <option {{ old('estratificacion', $empresa->estratificacion) == 1 ? 'selected' : '' }}  value="1">Micro</option>
                    <option {{ old('estratificacion', $empresa->estratificacion) == 2 ? 'selected' : '' }} value="2">Pequeña</option>
                    <option {{ old('estratificacion', $empresa->estratificacion) == 3 ? 'selected' : '' }} value="3">Mediana</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Link al Documento que Acredite la Estratificacíon</label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="link_estratificacion" value="{{ old('link_estratificacion', $empresa->link_estratificacion) }}" placeholder="Link al Documento que Acredite la Estratificacíon" />
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-label col-form-label col-md-3">Link a la solicitud de Inscripción al Padrón de Contratistas <i class="fas fa-circle-info" data-toggle="tooltip" title='Escrito dirigido a la C. Arq. Urb. Irene Jiménez Montiel, titular de la Secretaría de Desarrollo Urbano, Obras Públicas y Ordenamiento Territorial, solicitando la Inscripcion al Padrón de Contratistas e indicando las especialidades (formato CE-1), que la persona física o moral requiera, según su experiencia comprobable. Agregar al final del escrito la leyenda: "Manifiesto bajo protesta de decir verdad que los documentos e información proporcionada son fidedignos y veraces". '></i></label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="link_solicitud" value="{{ old('link_solicitud', $empresa->link_solicitud) }}" placeholder="Link al Documento donde se Solicita la Inscripcion al Padrón de Contratistas" />
            </div>
        </div>



        <div class="row">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary w-100px">Actualizar</button>
            </div>
        </div>
    </fieldset>
</form>
