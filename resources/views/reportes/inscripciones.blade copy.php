<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8"/>
    <title>constancia</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name=""/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        @page {
                size: LETTER;
                margin: 5mm 10mm 5mm 10mm;
        }

        @media print {

                footer {
                    position: fixed;
                    bottom: 0;
                }

                .content-block, p {
                    page-break-inside: avoid;
                }

                html, body {
                    width: 215.9mm;
                    height: 279.4mm;
                }

                .tabla{
                    text-align: center;
                    font-size:9px;
                }

                table, th, td {
                    border: 1px solid black;
                    margin-bottom: 20mm;
                }


        }


        .titulo {
            text-align: center;
            -o-object-fit: fill;
            object-fit: fill;
        }

        .primer-parrafo {
            margin-top: 15px;

        }

        .segundo-parrafo {
            margin-top: 15px;

        }

        .text-center {
            text-align: center;
        }


    </style>
</head>
<body>
    <div class="container">


            <div class="section">
                <div class="d-flex align-items-center">

                    <div style="text-align: left; "><img src="{{ asset('/constancia/Gobierno_Logo_Transparente.png') }}" width="70%" height="70%" alt=""/></div>

                    <div style="text-align: right; "><img src="{{ asset('/constancia/SDUOPOT_Logo_Transparente.png') }}" width="70%" height="70%" alt=""/></div>

                </div>
            </div>



            <div class="titulo" style="margin-top: 10px; font-size:25px;">


                    <div style="text-align: center; "><b>PADRÓN DE CONTRATISTAS DEL ESTADO DE GUERRERO</b></div>


            </div>



            <div class="row primer parrafo">
                <div class="text-center" style="font-size:12px;"><br /><p>
                    LA SECRETARÍA DE DESARROLLO URBANO, OBRAS PUBLICAS Y ORDENAMIENTO TERRITORIAL, EN CUMPLIMIENTO DEL ARTÍCULO 35, DE LA LEY DE OBRAS PUBLICAS Y SUS SERVICIOS DEL ESTADO DE GUERRERO No. 266,
                    PUBLICA LOS NOMBRES DE LAS PERSONAS REGISTRADAS EN EL PADRÓN DE CONTRATISTAS.
                    RELACIÓN DE EMPRESAS INSCRITAS EN EL PADRÓN DE CONTRATISTAS, ASI COMO LAS QUE REFRENDARON SU REGISTRO
                    PERIODO 2021-2022.</p>
                </div>
            </div>

            <div class="row segundo parrafo">
                <div class="text-center" style="font-size:12px;">
                    <p>RELACIÓN DE EMPRESAS INSCRITAS EN EL PADRÓN DE CONTRATISTAS, ASI COMO LAS QUE REFRENDARON SU REGISTRO PERIODO 2021-2022.</p>
                    <p><b>INSCRIPCIONES</b></p>
                </div>
            </div>


            <div class="row tabla">

                <table style="width:100%">
                    <tr>
                        <th>Num.</th>
                        <th>Empresa</th>
                        <th>Representante Legal</th>
                        <th>Especialidades</th>
                        <th>Folio</th>
                    </tr>


                    @foreach ($inscripciones as $inscripcion)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ ($inscripcion->nombre_empresa == 'N/A' ? strtoupper($inscripcion->nombre_persona) : strtoupper($inscripcion->nombre_empresa))  }} </td>
                            <td>{{ ($inscripcion->representantes()->exists()? strtoupper($inscripcion->representantes->nombre_representante):strtoupper($inscripcion->nombre_persona)) }}</td>
                            <td>
                                @foreach ( $inscripcion->especialidades as $especialidad)

                                    @if($loop->last)
                                        {{  substr($especialidad->especialidad->nombre, 0, 3) }}
                                    @else
                                        {{  substr($especialidad->especialidad->nombre, 0, 3) }},
                                    @endif

                                @endforeach
                            </td>
                            <td>{{ $inscripcion->folio->folio }}</td>
                        </tr>
                    @endforeach

                </table>

            </div>


            <footer>


                <div class="row" style="margin-top: 10px; font-size:10px;">
                    <div>Recinto de las Oficinas del Poder Ejecutivo del Estado, Edificio Acapulco 2° Piso<br/>Boulevard Rene Juárez Cisneros #62, Col. Ciudad de los Servicios C.P. 39075, Chilpancingo Gro. Tel: (747) 471 9832. www.guerrero.gob.mx email: sduopguerrero@gmail.com</div>
                    <img style="margin-top: 10px;" src="{{ asset('/constancia/cintillo_delgado_guerrero.png') }}" alt="" /></div>
                </div>


            </footer>

    </div>
</body>
</html>
