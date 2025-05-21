<table>
    <thead>
    <tr>
        <th style="width:100px"><b>Tipo</b></th>
        <th style="width:100px"><b>Folio Padrón</b></th>
        <th style="width:100px"><b>Año de Refrendo</b></th>
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
    @foreach($refrendos as $refrendo)
        <tr>
            <td>{{ $refrendo->empresa->tipo == 1 ? 'Moral' : 'Física'}}</td>
            <td>{{ isset($refrendo->empresa->folio->folio) ? $refrendo->empresa->folio->folio : 'N/A' }}</td>
            <td>{{ $refrendo->ejercicio }}</td>
            <td>{{ $refrendo->empresa->rfc_empresa }}</td>
            <td>{{ $refrendo->empresa->nombre_empresa }}</td>
            <td>{{ $refrendo->empresa->nombre_persona }}</td>
            <td>{{ $refrendo->empresa->domicilio }}</td>
            <td>{{ $refrendo->empresa->colonia }}</td>
            <td>{{ $refrendo->empresa->codigo_postal }}</td>
            <td>{{ $refrendo->empresa->estado->nombre }}</td>
            <td>{{ $refrendo->empresa->municipio->nombre }}</td>
            <td>{{ $refrendo->empresa->localidad->nombre }}</td>
            <td>{{ $refrendo->empresa->telefono }}</td>
            <td>{{ $refrendo->empresa->email }}</td>


            @php

                $empresa = $refrendo->empresa;

                if(isset($refrendo->empresa->url_empresa)){

                    $urlEmpresa = $refrendo->empresa->url_empresa;

                }else{

                    $temp = Refrendo::where('empresa_id','=', $empresa->id)->where('ejercicio','=', 2024);

                    $urlEmpresa = $temp->pagina_refrendo;

                }


                if(isset($refrendo->empresa->representantes->nombre_representante)){

                    $nombreRepresentante = $refrendo->empresa->representantes->nombre_representante;

                }else{

                    $temp = Refrendo::where('empresa_id','=', $empresa->id)->where('ejercicio','=', 2024);

                    $nombreRepresentante = $temp->representante_refrendo;

                }


                if(isset($refrendo->empresa->representantes->estadoRegistro->nombre)){

                    $estadoRepresentante = $refrendo->empresa->representantes->estadoRegistro->nombre;

                }else{

                    $temp = Refrendo::where('empresa_id','=', $empresa->id)->where('ejercicio','=', 2024);

                    $estadoRepresentante = $temp->empresa->representantes->estadoRegistro->nombre;

                }


                if(isset($refrendo->empresa->representantes->ciudad_registro)){

                    $ciudadRepresentante = $refrendo->empresa->representantes->ciudad_registro;

                }else{

                    $temp = Refrendo::where('empresa_id','=', $empresa->id)->where('ejercicio','=', 2024);

                    $ciudadRepresentante = $temp->empresa->representantes->ciudad_registro;
                }

            @endphp


            <td>{{ isset($urlEmpresa) ? $urlEmpresa : 'N/A' }}</td>
            <td>{{ isset($nombreRepresentante) ? $nombreRepresentante : 'N/A' }}</td>
            <td>{{ isset($estadoRepresentante) ? $estadoRepresentante : 'N/A' }}</td>
            <td>{{ isset($ciudadRepresentante) ? $ciudadRepresentante : 'N/A'}}</td>
            <td>{{ $refrendo->empresa->telefono_representante }}</td>
            <td>{{ $refrendo->empresa->email_representante }}</td>

            <td>{{ $refrendo->empresa->nombre_expide }}</td>
            <td>
                @foreach ( $refrendo->empresa->especialidades as $especialidad)

                    @if($loop->last)
                        {{  substr($especialidad->especialidad->nombre, 0, 3) }}
                    @else
                        {{  substr($especialidad->especialidad->nombre, 0, 3) }},
                    @endif

                @endforeach

            </td>
            <td>
                @switch($refrendo->empresa->estratificacion)
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
            <td>{{ $refrendo->created_at }}</td>
            <td>{{ isset($refrendo->fecha_expedicion) ? $refrendo->getRawOriginal('fecha_expedicion') : 'N/A' }}</td>
            <td>
                @switch($refrendo->empresa->estatus)
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
