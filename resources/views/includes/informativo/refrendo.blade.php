
                <form method="" action="" autocomplete="off" id="formRefrendo">
                    <fieldset>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Solicitud de Refrendo. <i class="fas fa-circle-info" data-toggle="tooltip" title='Escrito dirigido a la C. Arq. Urb. Irene Jiménez Montiel, titular de la Secretaría de Desarrollo Urbano, Obras Públicas y Ordenamiento Territorial, solicitando su Refrendo al Padrón Único de Contratistas e indicando las especialidades, que la persona física o moral requiera, según su experiencia comprobable. Agregar al final del escrito la leyenda: "Manifiesto bajo protesta de decir verdad que los documentos e información proporcionada son fidedignos y veraces"'></i>
                            </label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{$refrendo->solicitud_refrendo}}" readonly/>
                            </div>
                            <div class="col-md-2">
                                <a href='{{$refrendo->solicitud_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Acta Constitutiva. <i class="fas fa-circle-info" data-toggle="tooltip" title='Anexar Copia del acta(s) modificatoria(s) al Acta Constitutiva debidamente inscrita en el Registro Público de la Propiedad.'></i></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{$refrendo->acta_refrendo}}" readonly/>
                            </div>
                            <div class="col-md-2">
                                <a href='{{$refrendo->acta_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Representante Legal. <i class="fas fa-circle-info" data-toggle="tooltip" title='Representante Legal.'></i></label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{$refrendo->representante_refrendo}}" readonly/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Domicilio. <i class="fas fa-circle-info" data-toggle="tooltip" title='Debe coincidir con el comprobante que se anexa.'></i>
                            </label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{$refrendo->domicilio_texto_refrendo}}" readonly/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Comprobante de Domicilio. <i class="fas fa-circle-info" data-toggle="tooltip" title='3.1 - Escrito dirigido al titular de la SDUOPOT, en el que se manifieste el domicilio de la empresa, así como mencionar los datos de contacto:
                                Números telefónicos y correo electrónico de la misma. *Agregar al final del escrito la leyenda: "Manifiesto bajo protesta de decir verdad que los documentos e información proporcionada son fidedignos y veraces". 3.2 - Comprobante actualizado del mismo, con antigüedad menor a tres meses a nombre de la empresa moral o en caso de Persona física, a nombre del Representante Legal (De lo contrario anexar una Carta de Arrendamiento vigente). 3.3 - Macro localización (Croquis de la ubicación del mismo), Micro localización (Fotografías de la fachada del domicilio).'></i>
                            </label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{$refrendo->domicilio_refrendo}}" readonly/>
                            </div>
                            <div class="col-md-2">
                                <a href='{{$refrendo->domicilio_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Página web del contratista. <i class="fas fa-circle-info" data-toggle="tooltip" title='Enlace de una página web oficial en donde aparezca el nombre de su empresa, su giro comercial y contacto.'></i>
                            </label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{$refrendo->pagina_refrendo}}" readonly/>
                            </div>
                            <div class="col-md-2">
                                <a href='{{$refrendo->pagina_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Constancia de capacitación. <i class="fas fa-circle-info" data-toggle="tooltip" title='Actualizada al año en curso, emitida por las instituciones autorizadas por la Ley de Obras Públicas y sus Servicios del Estado de Guerrero, artículo 31 Fracción X.'></i>
                            </label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{$refrendo->constancia_refrendo}}" readonly/>
                            </div>
                            <div class="col-md-2">
                                <a href='{{$refrendo->constancia_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Documento de estratificación.
                            </label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{$refrendo->estratificacion_refrendo}}" readonly/>
                            </div>
                            <div class="col-md-2">
                                <a href='{{$refrendo->estratificacion_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Declaración fiscal. <i class="fas fa-circle-info" data-toggle="tooltip" title='Del ejercicio inmediato anterior y Opinión de cumplimiento positiva del SAT 32-D.  Anexo del Estado de Situación financiera ante el Servicio de Administración Tributaria'></i>
                            </label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{$refrendo->declaracion_refrendo}}" readonly/>
                            </div>
                            <div class="col-md-2">
                                <a href='{{$refrendo->declaracion_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="form-label col-form-label col-md-3">Facturas de maquinaria y equipo. <i class="fas fa-circle-info" data-toggle="tooltip" title='Anexar Contrato Completo junto a su respectiva Acta de Entrega, en donde acredite la experiencia con obras similares a las especialidades que solicita.
                                *Un Contrato mínimo por cada especialidad solicitada. * Vease Anexo Catalogo de Especialidades'></i>
                            </label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" value="{{$refrendo->maquinaria_refrendo}}" readonly/>
                            </div>
                            <div class="col-md-2">
                                <a href='{{$refrendo->maquinaria_refrendo}}' class='btn btn-xs btn-green w-60px me-1' target='_blank'> Enlace </a>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="d-flex">
                                <h4>Notas para la revisión:</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="nota_refrendo" id="editorNotaRefrendo">
                                    {{ $refrendo->nota_refrendo }}
                                </textarea>
                                <script>
                                        window.addEventListener("load", (e)=>{
                                            ClassicEditor.create( document.querySelector('#editorNotaRefrendo' ),{
                                            } )
                                            .then(editor => {
                                                editor.isReadOnly; // `false`.
                                                    editor.enableReadOnlyMode( '#editorNotaRefrendo' );
                                                    const toolbarElement = editor.ui.view.toolbar.element;
                                                    toolbarElement.style.display = 'none';
                                            } ) .catch( error => {
                                                console.error( error );
                                            } );
                                        });
                                </script>
                            </div>
                        </div>
                        <br />

                    </fieldset>
                </form>

                <br />
                <br />

                <div class="row g-3">
                    <div class="col-sm-12">
                        <h3>Especialidades.</h3>
                    </div>
                </div>

                <br />
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableEspecialidades" width="100%" cellspacing="0">
                            <colgroup>
                                <col style="width: 45%;">
                                <col style="width: 25%;">
                                <col style="width: 10%;">

                            </colgroup>

                            <thead>
                                <tr>
                                    <th>Especialidad</th>
                                    <th style="text-align:center">Link</th>
                                    <th style="text-align:center">Refrendo</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Especialidad</th>
                                    <th style="text-align:center">Link</th>
                                    <th style="text-align:center">Refrendo</th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
