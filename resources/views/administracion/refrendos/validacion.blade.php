<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validación de Datos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .flex-container {

            flex-wrap: nowrap;
            justify-content: flex-start;
        }

        .item {

            align-self: auto;

        }

        img {
            border-radius: 25px;
            background: #73AD21;
            margin-bottom: 10px;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card text-white {{ $estatus }} mb-3">
                    @if ($folio->empresa->estatus != 'V')

                        <div class="card-header">Empresa: <b>{{ $folio->empresa->rfc_empresa }} - {{ ($folio->empresa->nombre_empresa != "N/A" ? $folio->empresa->nombre_empresa : $folio->empresa->nombre_persona) }}</b></div>
                        <div class="card-body bg-secondary">
                            <div class="flex-container">
                                <div class="item">
                                    <img class="img-fluid" src="{{ asset('constancia/Padron_Logo.jpeg') }}">
                                </div>

                                <div class="item">
                                    <h5 class="card-title ">Información</h5>

                                    <p class="card-text"><b>Representante:</b></p>
                                    <p>
                                        <ul>
                                            <li>{{ $folio->empresa->tipo == '1' ? strtoupper($folio->empresa->representantes->nombre_representante) : strtoupper($folio->empresa->nombre_persona) }}</li>
                                        </ul>
                                    </p>

                                    <p class="card-text"><b>Especialidades:</b></p>
                                    <p>
                                        La empresa se encuentra en proceso de revisión, no es posible enlistar las especialidades.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-success"><b>La empresa se encuentra en proceso de revisión, no cuenta con una vigencia activa.</b></div>

                    @else
                        <div class="card-header">Empresa: <b>{{ $folio->empresa->rfc_empresa }} - {{ ($folio->empresa->nombre_empresa != "N/A" ? $folio->empresa->nombre_empresa : $folio->empresa->nombre_persona) }}</b></div>
                        <div class="card-body bg-secondary">
                            <div class="flex-container">
                                <div class="item">
                                    <img class="img-fluid" src="{{ asset('constancia/Padron_Logo.jpeg') }}">
                                </div>

                                <div class="item">
                                    <h5 class="card-title ">Información</h5>

                                    <p class="card-text"><b>Representante:</b></p>
                                    <p>
                                        <ul>
                                            <li>{{ $folio->empresa->tipo == '1' ? strtoupper($folio->empresa->representantes->nombre_representante) : strtoupper($folio->empresa->nombre_persona) }}</li>
                                        </ul>
                                    </p>

                                    <p class="card-text"><b>Especialidades:</b></p>
                                    <p>
                                        <ul>
                                            @foreach ($folio->empresa->especialidades as $especialidad)
                                                <li>{{ $especialidad->especialidad->nombre }}</li>
                                            @endforeach
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-success"><b>Vigencia:</b> {{ date('d-M-Y', strtotime($folio->vigencia))  }}</div>

                    @endif
                </div>
            </div>
        </div>

    </div>


</body>
</html>
