<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Validación de Datos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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
                                                <li>{{ $especialidad->especialidad->nombre }} - {{ isset($especialidad->ejercicio) ? $especialidad->ejercicio : substr($folio->fecha_expedicion, -4) }}</li>
                                            @endforeach
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-success"><b>Vigencia:</b> {{ $folio->empresa->refrendos()->count() > 0 ?  'Ver Refrendos' : date('d-M-Y', strtotime($folio->vigencia)) }}</div>

                    @endif
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card text-white bg-success mb-3">

                        <div class="card-header"><b>Refrendos</b></div>

                            @foreach ($folio->empresa->refrendos as $refrendo)
                                @if($refrendo->estatus == 'V')
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                    <b>{{ $refrendo->ejercicio }} - Vigencia: {{ date('d-M-Y', strtotime($refrendo->vigencia))  }}</b>
                                                </button>
                                            </h2>
                                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                    <b>{{ $refrendo->ejercicio }} - Vigencia: Los datos para este refrendo estan siendo validados.</b>
                                                </button>
                                            </h2>
                                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        <div class="card-footer bg-transparent border-success"><b>Refrendos</b></div>

                </div>
            </div>
        </div>



    </div>


</body>
</html>
