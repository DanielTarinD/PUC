<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">RFC {{ $empresa->tipo == '1' ? 'de la Empresa' : 'de  la Persona' }}</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->rfc_empresa }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Tipo de Registro</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->motivo_empresa == "1" ? 'Registro' : 'Refrendo'}}"  readonly/>
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Refrendo o Registro del Año anterior</label>
    <div class="col-md-7">
        <input type="text" class="form-control" value="{{$empresa->enlace_refrendo}}"  readonly/>
    </div>

    <div class="col-md-2">
        <a href='{{$empresa->enlace_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
    </div>
</div>

@if ($empresa->tipo == '1')
    <div class="row mb-3">
        <label class="form-label col-form-label col-md-3">Nombre de la Empresa</label>
        <div class="col-md-9">
            <input type="text" class="form-control" value="{{ $empresa->nombre_empresa }}" readonly/>
        </div>
    </div>
@else
    <div class="row mb-3">
        <label class="form-label col-form-label col-md-3">Nombre la Persona Física</label>
        <div class="col-md-9">
            <input type="text" class="form-control" value="{{ $empresa->nombre_persona }}" readonly/>
        </div>
    </div>

    <div class="row mb-3">
        <label class="form-label col-form-label col-md-3">Cargo</label>
        <div class="col-md-9">
            <input type="text" class="form-control" value="{{ $empresa->cargo_persona }}" readonly/>
        </div>
    </div>

@endif



<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Link a o las Actas <i class="fas fa-circle-info" data-toggle="tooltip" title='Acta Constitutiva debidamente inscrita en el Registro Público de la Propiedad. *Presentar Original para cotejo.'></i></label>
    <div class="col-md-7">
        <input type="text" class="form-control" value="{{$empresa->link_acta}}" readonly/>
    </div>
    <div class="col-md-2">
        <a href='{{$empresa->link_acta}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Link al Curriculum de la Persona o Empresa <i class="fas fa-circle-info" data-toggle="tooltip" title='De la persona física o moral, incluyendo su organigrama y el curriculum de cada uno del personal que soporte el mismo. - Para las especialidades requeridas se deberá acreditar su experiencia en obras similares mediante Contratos y Actas de Entrega Recepción.'></i></label>
    <div class="col-md-7">
        <input type="text" class="form-control" value="{{$empresa->link_cv}}" readonly/>
    </div>
    <div class="col-md-2">
        <a href='{{$empresa->link_cv}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Estado</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->estado->nombre }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Municipio</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->municipio->nombre }}" readonly />
    </div>
</div>


<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Localidad</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->localidad->nombre }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Colonia</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->colonia }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Domicilio</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->domicilio }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Código Postal</label>
    <div class="col-md-9">
        <input type="text" class="form-control"  value="{{ $empresa->codigo_postal }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Link al escrito que manifieste el domicilio en el Estado <i class="fas fa-circle-info" data-toggle="tooltip" title='Escrito en el que manifieste el domicilio en el Estado de Guerrero para oír y recibir todo tipo de notificación, así como mencionar números telefónicos y correo electrónico de la empresa
        - Comprobante del mismo con antigüedad menor de tres meses a nombre de la empresa o el Representante Legal (De lo contrario anexar Carta de Arrendamiento)
        - Macro localización (Croquis de la ubicación del mismo), Micro localización (Fotografias de la fachada del domicilio) * Presentar Original para cotejar.'></i></label>
    <div class="col-md-7">
        <input type="text" class="form-control" value="{{$empresa->link_domicilio}}" readonly/>
    </div>
    <div class="col-md-2">
        <a href='{{$empresa->link_domicilio}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Link al documento de Domicilio Fiscal <i class="fas fa-circle-info" data-toggle="tooltip" title='DOMICILIO FISCAL: Con respecto a las empresas foráneas, ademas del punto anterior, también se deberán anexar el documento de apertura de sucursal y/o establecimiento en el Estado, expedido por el Servicio de Administración Tributaria, así como el contrato de arrendamiento en su caso.'></i></label>
    <div class="col-md-7">
        <input type="text" class="form-control" value="{{$empresa->link_domicilio_fiscal}}" readonly/>
    </div>
    <div class="col-md-2">
        <a href='{{$empresa->link_domicilio_fiscal}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Teléfono del Representante Legal</label>
    <div class="col-md-9">
        <input type="text" class="form-control"  value="{{ $empresa->telefono_representante }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Teléfono de la Empresa</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->telefono }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Correo Representante</label>
    <div class="col-md-9">
        <input type="email" class="form-control"  value="{{ $empresa->email_representante }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Correo de la Empresa</label>
    <div class="col-md-9">
        <input type="email" class="form-control"  value="{{ $empresa->email }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">URL de la Empresa <i class="fas fa-circle-info" data-toggle="tooltip" title='.  Copia de la presentación física de la página web
        (Captura de pantalla del inicio y enlace de su pagina web en donde aparezca el nombre de su empresa, actividad y contacto de la empresa).'></i></label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{$empresa->url_empresa}}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Registro IMSS</label>
    <div class="col-md-9">
        <input type="text" class="form-control" value="{{ $empresa->imss }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Link al documento del Registro del IMSS <i class="fas fa-circle-info" data-toggle="tooltip" title='REGISTROS. Del IMSS (Aviso de Registro Patronal), con Factor/Prima de Riesgo clase V. - Cédula de Identificación Fiscal (RFC). *Presentar Original para cotejar.'></i></label>
    <div class="col-md-7">
        <input type="text" class="form-control" value="{{$empresa->link_registro}}" readonly/>
    </div>
    <div class="col-md-2">
        <a href='{{$empresa->link_registro}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Folio de Constancia de Capacitación</label>
    <div class="col-md-9">
        <input type="text" class="form-control"  value="{{ $empresa->folio_capacitacion }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Nombre de quien expide la Constancia de Capacitación</label>
    <div class="col-md-9">
        <input type="text" class="form-control"  value="{{ $empresa->nombre_expide }}" readonly />
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Link a la Constancia de Capacitación <i class="fas fa-circle-info" data-toggle="tooltip" title='CONSTANCIA DE CAPACITACIÓN. Actualizada al año en curso, emitida por las instituciones autorizadas por la Ley de Obras Públicas y sus Servicios del Estado de Guerrero, articulo 31 Fracción X. (La cual puede ser a traves de la, Secretaría del Trabajo, cualquier Institución autorizada por la Secretaría de Educación Pública o la Cámara Mexicana de la Industria de la Construcción). * Presentar Original para cotejar.'></i></label>
    <div class="col-md-7">
        <input type="text" class="form-control" value="{{$empresa->link_constancia}}" readonly/>
    </div>
    <div class="col-md-2">
        <a href='{{$empresa->link_constancia}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Link al Documento que Acredite la Estratificacíon</label>
    <div class="col-md-7">
        <input type="text" class="form-control" value="{{$empresa->link_estratificacion}}" readonly/>
    </div>
    <div class="col-md-2">
        <a href='{{$empresa->link_estratificacion}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
    </div>
</div>

<div class="row mb-3">
    <label class="form-label col-form-label col-md-3">Link a la solicitud de Refrendo/Inscripción al Padrón de Contratistas <i class="fas fa-circle-info" data-toggle="tooltip" title='Escrito dirigido a la C. Arq. Urb. Irene Jiménez Montiel, titular de la Secretaría de Desarrollo Urbano, Obras Públicas y Ordenamiento Territorial, solicitando la Inscripcion al Padrón de Contratistas e indicando las especialidades (formato CE-1), que la persona física o moral requiera, según su experiencia comprobable. Agregar al final del escrito la leyenda: "Manifiesto bajo protesta de decir verdad que los documentos e información proporcionada son fidedignos y veraces". '></i></label>
    <div class="col-md-7">
        <input type="text" class="form-control" value="{{$empresa->link_solicitud}}" readonly/>
    </div>
    <div class="col-md-2">
        <a href='{{$empresa->link_solicitud}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
    </div>
</div>
