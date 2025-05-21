    <div class="modal-header">
        <h4 class="modal-title">Crear Acceso</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
    </div>

    <div class="modal-body">

        <!-- BEGIN table-responsive -->
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <th colspan="2" style="text-align:center"><b>Datos del Preregistro</b></th>
                </thead>
                <tbody>
                    <tr class="table-info">
                        <td><b>RFC:</b></td>
                        <td>{{ $preregistro->rfc_empresa }}</td>
                    </tr>
                    <tr class="table-info">
                        <td><b>Nombre:</b></td>
                        <td>{{ $preregistro->nombre_empresa }}</td>
                    </tr>
                    <tr class="table-info">
                        <td><b>Correo:</b></td>
                        <td>{{ $preregistro->correo_contacto }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br />
        <!-- END table-responsive -->

        <form action="/preregistro/acceso" method="POST" autocomplete="off">
            @csrf
            <input type="hidden" class="form-control" name="preregistro_id" value="{{ $preregistro->id }}"/>
            <input type="hidden" class="form-control" name="rfc" value="{{ $preregistro->rfc_empresa }}"/>
            <input type="hidden" class="form-control" name="name" value="{{ $preregistro->nombre_responsable }}"/>
            <input type="hidden" class="form-control" name="email" value="{{ $preregistro->correo_contacto }}"/>
            <fieldset>
                <div class="row mb-3">
                    <label class="form-label col-form-label col-md-3">Contraseña</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="password" value="" placeholder="Contraseña" />
                    </div>
                </div>

                <div class="row">
                    <div class="d-flex justify-content-end">
                        <button  type="button" class="btn btn-danger w-100px me-5px" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary w-100px">Guardar</button>
                    </div>
                </div>
            </fieldset>
        </form>

    </div>
