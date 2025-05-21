    <div class="modal-header">
        <h4 class="modal-title">Acceso</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
    </div>

    <div class="modal-body">

        <!-- BEGIN table-responsive -->
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <th colspan="2" style="text-align:center"><b>Datos del Acceso</b></th>
                </thead>
                <tbody>
                    <tr class="table-info">
                        <td><b>Nombre:</b></td>
                        <td>{{ $preregistro->nombre_responsable }}</td>
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

    </div>
    <div class="modal-footer">
        <a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Cerrar</a>
    </div>
