<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8"/>
    <title>constancia</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name=""/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="{{ asset('/constancia/constancia.css') }}" rel="stylesheet" type="text/css"/>
    <style>

        @page {
            size: LETTER;
            margin: 11mm 10mm 10mm 10mm;
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
        }

        ul{
            margin-left: 50px;;
            columns: 2;
            -webkit-columns: 2;
            -moz-columns: 2;
        }


    </style>
</head>
<body>
    <div class="container">


            <div class="section">
                <div class="d-flex align-items-center">

                    <div style="text-align: left; "><img src="{{ asset('/constancia/SDUPOT_Logo_Transparente.png') }}" width="70%" height="70%" alt=""/></div>

                    <div style="text-align: right; "><img src="{{ asset('/constancia/Padron_Logo_Transparente.png') }}" width="70%" height="70%" alt=""/></div>

                </div>
            </div>

            <div class="d-flex flex-row-reverse" style="margin-top: 10px;">
                    <table>
                        <tr>
                            <td><b>SECCIÓN: </b></td>
                            <td style="text-align:right; font-size:10px; "> DIRECCIÓN DE COSTOS,PRESUPUESTOS,<br />LICITACIONES Y CONTRATOS.</td>
                        </tr>
                        <tr>
                            <td><b>OFICIO N°: </b></td>
                            <td style="text-align:right; font-size:10px;">{{ $empresa->folio->folio_jefatura }}.<br/></td>
                        </tr>
                        <tr>
                            <td><b>ASUNTO: </b></td>
                            <td style="text-align:right; font-size:10px;">
                                {{ $empresa->motivo_empresa == '1' ? 'CONSTANCIA DE INSCRIPCION': 'CONSTANCIA DE REFRENDO' }}

                            </td>
                        </tr>
                    </table>
            </div>

            <div class="row leyenda">
                <div class="fecha" style="text-align:right; font-size:12px;">Chilpancingo de los Bravo, Gro., a {{ $fechaExpedicion }}
                    <br/>
                    <b style="margin-top: 5px;">“2022, Año de Ricardo Flores Magón”</b>
                    @if ($empresa->motivo_empresa == '2')
                        <br /><br /><h4>REFRENDO 2022 - 2023</h4>
                    @endif

                    <b style="text-align:right; font-size:14px;">Válido Hasta el 31 de Mayo de 2023.</b>
                </div>
            </div>




            <div class="row">
                <div class="col-12">
                    <b>{{ $empresa->tipo == '1' ? $empresa->nombre_empresa : $empresa->nombre_persona}}</b><br />
                    REPRESENTANTE LEGAL: <b>{{ $empresa->tipo == '1' ? $empresa->representantes->nombre_representante : $empresa->nombre_persona }}</b><br/>
                    {{ strtoupper($empresa->domicilio) }}<br/>
                    COL. {{ strtoupper($empresa->colonia) }}, CP. {{ strtoupper($empresa->codigo_postal) }}.<br/>
                    {{ strtoupper($empresa->municipio->nombre ) }}, {{ strtoupper($empresa->estado->abreviatura ) }}
                </div>

            </div>


            <div class="row primer-texto">
                <div class="text-block-3" style="font-size:14px;">En atención a su Solicitud y en virtud de haber acreditado lo dispuesto en el articulo 31 de La Ley de Obras Públicas y sus Servicios del Estado de Guerrero número 266, hago de su conocimiento que la SecretariaDe Desarrollo Urbano, Obras Publicas Y Ordenamiento Territorial, ha tenido a bien registrarlo en el Padrón de Contratistas del Gobierno del Estado de Guerrero, con el numero <b>{{ $empresa->folio->folio }}</b>, y de acuerdo al articulo 30 de la ley en mención, se le asignan la (s) especialidad (es) número(s):</div>
            </div>

            <div class="row" style="margin-top: 20px; font-size:10px;">
                <ul>

                    @foreach ($empresa->especialidades as $especialidad)
                        <li style="font-size:16px;"><b> {{ substr($especialidad->especialidad->nombre, 0, 3) }}</b>{{ substr($especialidad->especialidad->nombre, 3) }}</li>
                    @endforeach

                </ul>
            </div>


            <div style="font-size:14px; text-align: justify;">Así mismo, se le recuerda que con fundamento en el articulo 32 de la ley en comento, el registro en el Padrón de Contratistas tendrá Vigencia Indefinida, siempre y cuando se cumpla con la obligación de Refrendarlo anualmente.</div>

            <div style="margin-top: {{ $empresa->especialidades()->count() > 4 ? 10 : 40 }}px;font-size:16px; text-align: center;">
                <b>A T E N T A M E N T E.</b><br/>
                La Secretaria de Desarrollo Urbano, <br/>
                Obras Publicas y Ordenamiento Territorial.
                ‍<br/>  ‍<br/> ‍<br/>

                @if ($empresa->especialidades()->count() < 4)
                    <br />
                @endif



                <b style="font-size:18px;">ARQ. URB. IRENE JIMÉNEZ MONTIEL</b>
            </div>

            <footer>

                <div class="row">
                    <div class="col-8 ccp fst-italic" style="margin-top: 65px;font-size:10px;">
                        <small>C.C.P. Lic. Ernesto Barrera Florentino- Titular de la Unidad de Asuntos Jurídicos de la SDUOPOT – para su conocimiento- Presente.<br/>
                            C.C.P. Lic. Eduardo Ortiz Sánchez – Titular del Órgano Interno de Control de la SDUOPOT – para su conocimiento- Presente.<br/>
                            C.C.P. Ing. Oscar Omar Hernández Fuentes - Director de Costos, Presupuestos, Licitaciones y Contratos de la SDUOPOT – para su conocimiento- Presente.<br/>
                            C.C.P. archivo.<br/>
                            <b>IJM *OOHF - cgib</b>
                        </small>
                    </div>

                    <div class="col-4" style="text-align: center;">
                        <img class="qr" src='data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge('https://padron.sduopotguerrero.com/constancia/jaguar.png', .2, true)->size(120)->generate('https://padron.sduopotguerrero.com/validacion/'.$empresa->folio->uuid.'/'.$empresa->rfc_empresa)) !!} '>
                    </div>
                </div>

                <div class="row" style="margin-top: 10px; font-size:10px;">
                    <div>Recinto de las Oficinas del Poder Ejecutivo del Estado, Edificio Acapulco 2° Piso<br/>Boulevard Rene Juárez Cisneros #62, Col. Ciudad de los Servicios C.P. 39075, Chilpancingo Gro. Tel: (747) 471 9832. www.guerrero.gob.mx email: sduopguerrero@gmail.com</div>
                    <img style="margin-top: 10px;" src="{{ asset('/constancia/cintillo_delgado.png') }}" alt="" class="image"/></div>
                </div>
            </footer>

    </div>
</body>
</html>
