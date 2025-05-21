<table>
    <thead>
    <tr>
        <th style="width:100px"><b>Tipo</b></th>
        <th style="width:100px"><b>Folio Padrón</b></th>
        <th style="width:100px"><b>Tipo de Registro</b></th>
        <th style="width:100px"><b>RFC</b></th>
        <th style="width:300px"><b>Nombre Empresa</b></th>
        <th style="width:300px"><b>Nombre de Persona Física</b></th>
        <th style="width:400px"><b>Domicilio</b></th>
        <th style="width:300px"><b>Colonia</b></th>
        <th style="width:100px"><b>C.P.</b></th>
        <th style="width:100px"><b>Estado</b></th>
        <th style="width:400px"><b>Municipio</b></th>
        <th style="width:400px"><b>Localidad</b></th>
        <th style="width:100px"><b>Teléfono</b></th>
        <th style="width:400px"><b>Correo Electrónico</b></th>
        <th style="width:400px"><b>Pagina Web</b></th>
        <th style="width:400px"><b>Nombre del Representante Legal</b></th>
        <th style="width:400px"><b>Estado de Registro del del Representante Legal</b></th>
        <th style="width:400px"><b>Ciudad de Registro del Representante Legal</b></th>
        <th style="width:400px"><b>Telefono del Representante Legal</b></th>
        <th style="width:400px"><b>Correo Electrónico del Representante Legal</b></th>
        <th style="width:300px"><b>Capacitado por:</b></th>
        <th style="width:400px"><b>Especialidades</b></th>
        <th style="width:100px"><b>Estratificación</b></th>
        <th style="width:100px"><b>Fecha</b></th>
        <th style="width:100px"><b>Fecha de Expedición</b></th>
        <th style="width:100px"><b>Estatus</b></th>

    </tr>
    </thead>
    <tbody>
    @foreach($empresas as $empresa)
        <tr>
            <td>{{ $empresa->tipo == 1 ? 'Moral' : 'Física'}}</td>
            <td>{{ isset($empresa->folio->folio) ? $empresa->folio->folio : 'N/A' }}</td>
            <td>{{ $empresa->motivo_empresa == 1 ? 'Inscripción' : 'Refrendo'}}</td>
            <td>{{ $empresa->rfc_empresa }}</td>
            <td>{{ $empresa->nombre_empresa }}</td>
            <td>{{ $empresa->nombre_persona }}</td>
            <td>{{ $empresa->domicilio }}</td>
            <td>{{ $empresa->colonia }}</td>
            <td>{{ $empresa->codigo_postal }}</td>
            <td>{{ $empresa->estado->nombre }}</td>
            <td>{{ $empresa->municipio->nombre }}</td>
            <td>{{ $empresa->localidad->nombre }}</td>
            <td>{{ $empresa->telefono }}</td>
            <td>{{ $empresa->email }}</td>
            <td>{{ $empresa->url_empresa }}</td>

            <td>{{ isset($empresa->representantes->nombre_representante) ? $empresa->representantes->nombre_representante : 'N/A' }}</td>
            <td>{{ isset($empresa->representantes->estadoRegistro->nombre) ? $empresa->representantes->estadoRegistro->nombre : 'N/A' }}</td>
            <td>{{ isset($empresa->representantes->ciudad_registro) ? $empresa->representantes->ciudad_registro : 'N/A'}}</td>
            <td>{{ $empresa->telefono_representante }}</td>
            <td>{{ $empresa->email_representante }}</td>

            <td>{{ $empresa->nombre_expide }}</td>
            <td>
                @foreach ( $empresa->especialidades as $especialidad)

                    @if($loop->last)
                        {{  substr($especialidad->especialidad->nombre, 0, 3) }}
                    @else
                        {{  substr($especialidad->especialidad->nombre, 0, 3) }},
                    @endif

                @endforeach

            </td>
            <td>
                @switch($empresa->estratificacion)
                    @case(1)
                            Micro
                        @break

                    @case(2)
                            Pequeña
                        @break

                    @case(3)
                            Mediana
                        @break
                @endswitch
            </td>
            <td>{{ $empresa->created_at }}</td>
            <td>{{ isset($empresa->folio->fecha_expedicion) ? $empresa->folio->getRawOriginal('fecha_expedicion') : 'N/A' }}</td>
            <td>
                @switch($empresa->estatus)
                    @case('N')
                            Nueva
                        @break

                    @case('R')
                            Revisión
                        @break

                    @case('O')
                            Observada
                        @break
                    @case('V')
                            Validada
                    @break
                @endswitch
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
