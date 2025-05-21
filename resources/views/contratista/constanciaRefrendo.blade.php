<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8"/>
    <title>{{ $refrendo->empresa->rfc_empresa }}</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name=""/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="{{ asset('/constancia/constancia.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>


        @media print {

                @page {
                        size: LETTER;
                        margin: 5mm 10mm 5mm 10mm;
                }

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

                ul{
                    margin-left: 10px;
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                }

                li {
                    list-style-type: none;
                    position: relative;    /* It's needed for setting position to absolute in the next rule. */
                }

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

            <div class="d-flex flex-row-reverse" style="margin-top: 10px;">
                    <table>
                        <tr>
                            <td style="text-align:left;"><b>SECCIÓN    :</b></td>
                            <td>&emsp;&emsp;&emsp;</td>
                            <td style="text-align:right; font-size:10px; "> DIRECCIÓN DE COSTOS, PRESUPUESTOS, <br />LICITACIONES Y CONTRATOS.</td>
                        </tr>
                        <tr>
                            <td style="text-align:left;"><b>OFICIO N°  :</b></td>
                            <td></td>
                            <td style="text-align:right; font-size:10px;">{{ $refrendo->folio_jefatura }}.<br/></td>
                        </tr>
                        <tr>
                            <td style="text-align:left; "><b>ASUNTO    : </b></td>
                            <td></td>
                            <td style="text-align:right; font-size:10px;">
                                    CONSTANCIA DE REFRENDO
                            </td>
                        </tr>
                    </table>
            </div>

            <div class="row leyenda">
                <div class="fecha" style="text-align:right; font-size:12px;">Chilpancingo de los Bravo, Gro., a {{ $fechaExpedicion }}
                    <br/>

                    @if (substr($refrendo->folio_jefatura, -4) === '2022')
                        <span style="margin-top: 10px; color: #ab0033;"><b>“2022, Año de Ricardo Flores Magón, Precursor de la Revolución Mexicana”</b></span>
                    @elseif (substr($refrendo->folio_jefatura, -4) === '2023')
                        <span   span style="margin-top: 10px; color: #ab0033;"><b>“2023, Año de Francisco Villa, el Revolucionario del Pueblo”</b></span>
                    @elseif (substr($empresa->folio->folio, -4) === '2024')
                        <span   span style="margin-top: 10px; color: #ab0033;"><b>“2024, Año de Felipe Carrillo Puerto,<br /> Benemérito del Proletariado, Revolucionario y Defensor del Mayab”</b></span>
                    @elseif (substr($empresa->folio->folio, -4) === '2025')
                        <span   span style="margin-top: 10px; color: #ab0033;"><b>“2025, Año de la Mujer Indígena”</b></span>
                    @else

                    @endif

                        <br /><br />
                        <h4>REFRENDO 2024 - 2025</h4>

                    <span style="text-align:right; font-size:14px; color: #bc955c;"><b>Válido Hasta el 30 de Junio de 2025.</b><span>
                </div>
            </div>




            <div class="row">
                <div class="col-12">
                    <b>{{ $refrendo->empresa->tipo == '1' ? mb_strtoupper($refrendo->empresa->nombre_empresa) : mb_strtoupper($refrendo->empresa->nombre_persona) }}</b><br />
                    RFC: <b>{{ $refrendo->empresa->rfc_empresa }}</b><br/>
                    REPRESENTANTE LEGAL: <b>{{ $refrendo->empresa->tipo == '1' ? mb_strtoupper((isset($refrendo->representante_refrendo) ? $refrendo->representante_refrendo : $refrendo->empresa->representantes->nombre_representante )) : mb_strtoupper($refrendo->empresa->nombre_persona) }}</b><br/>
                    {{ mb_strtoupper((isset($refrendo->domicilio_texto_refrendo) ? $refrendo->domicilio_texto_refrendo : $refrendo->empresa->domicilio)) }}<br/>
                    COL. {{ mb_strtoupper((isset($refrendo->colonia) ? $refrendo->colonia : $refrendo->empresa->colonia)) }}, CP. {{ strtoupper((isset($refrendo->codigo_postal) ? $refrendo->codigo_postal : $refrendo->empresa->codigo_postal)) }}.<br/>
                    {{ mb_strtoupper((isset($refrendo->municipio)  ? $refrendo->municipio->nombre : $refrendo->empresa->municipio->nombre) ) }}, {{ strtoupper((isset($refrendo->estado ) ? $refrendo->estado->abreviatura : $refrendo->empresa->estado->abreviatura )) }}
                </div>
            </div>


            <div class="row primer-texto">
                <div class="text-block-3" style="font-size:14px;">En atención a su Solicitud y en virtud de haber acreditado lo dispuesto en el artículo 31 de La Ley de Obras Públicas y sus Servicios del Estado de Guerrero número 266, hace de su conocimiento que la <i>Secretaría de Desarrollo Urbano, Obras Públicas Y Ordenamiento Territorial</i>, ha tenido a bien Refrendarlo en el Padrón Único de Contratistas del Gobierno del Estado de Guerrero, con el número <b>{{ $refrendo->empresa->folio->folio }}</b>, y de acuerdo al artículo 30 de la ley en mención, se le asignan la (s) especialidad (es) número(s):</div>
            </div>

            <div class="row" style="margin-top: 20px;">
                <ul>


                    @foreach ($refrendo->empresa->especialidades as $especialidad)

                            @if(strlen($especialidad->especialidad->nombre) > 35 && $refrendo->empresa->especialidades()->count() > 4)
                                <li><b><span style="color: #ab0033">&#9679;</span> {{ substr($especialidad->especialidad->nombre, 0, 3) }}</b><span style="font-size: 12px;">{{ substr($especialidad->especialidad->nombre, 3) }}</span></li>
                            @else
                                <li><b><span style="color: #ab0033">&#9679;</span> {{ substr($especialidad->especialidad->nombre, 0, 3) }}</b>{{ substr($especialidad->especialidad->nombre, 3) }}</li>
                            @endif

                    @endforeach


                </ul>
            </div>


            <div style="font-size:14px; text-align: justify;">Así mismo, se le recuerda que con fundamento en el articulo 32 de la ley en comento, el registro en el Padrón Único de Contratistas del Estado de Guerrero tendrá <i>Vigencia Indefinida</i>, siempre y cuando se cumpla con la obligación de Refrendarlo anualmente.</div>

            <div style="margin-top: {{ $refrendo->empresa->especialidades()->count() > 6 ? 15 : 60 }}px;font-size:16px; text-align: center;">
                <b>A T E N T A M E N T E.</b><br/>
                La Secretaria de Desarrollo Urbano, <br/>
                Obras Públicas y Ordenamiento Territorial.
                ‍<br/>  ‍<br/> ‍<br/>

                @if ($refrendo->empresa->especialidades()->count() < 4)
                    <br />
                @endif



                <b style="font-size:18px;">ARQ. URB. IRENE JIMÉNEZ MONTIEL</b>
            </div>

            <footer>

                <div class="row">
                    <div class="col-9 ccp fst-italic" style="margin-top: 100px;font-size:10px;">
                        <small>
                            c.c.p. Ing. Ogilbie García Guevara - Director de Costos, Presupuestos, Licitaciones y Contratos de la SDUOPOT – para su conocimiento- Presente.<br/>
                            c.c.p. archivo.<br/>
                            <div class="row">
                                <div class="col-4"><b>Elaboró: CGIB</b></div>
                                <div class="col-4"><b>Revisó: OGG</b></div>
                                <div class="col-4"><b>Vo. Bo. RGB</b></div>
                            </div>
                        </small>
                    </div>

                    <div class="col-3" style="text-align: center;">
                        <!-- <img class="qr" src='data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge('https://puc.guerrero.gob.mx/constancia/jaguar.png', .2, true)->size(120)->generate('https://puc.guerrero.gob.mx/validacion/'.$refrendo->empresa->folio->uuid.'/'.$refrendo->empresa->rfc_empresa)) !!} '> -->
                        <img class="qr" src='data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(120)->generate('https://puc.guerrero.gob.mx/validacion/'.$refrendo->empresa->folio->uuid.'/'.$refrendo->empresa->rfc_empresa)) !!} '>
                    </div>
                </div>

                <div class="row" style="margin-top: 10px; font-size:10px;">
                    <div>Recinto de las Oficinas del Poder Ejecutivo del Estado, Edificio Acapulco 2° Piso<br/>Boulevard Rene Juárez Cisneros #62, Col. Ciudad de los Servicios C.P. 39075, Chilpancingo Gro. Tel: (747) 471 9832. www.guerrero.gob.mx email: sduopguerrero@gmail.com</div>
                    <img style="margin-top: 10px;" src="{{ asset('/constancia/cintillo_delgado_guerrero.png') }}" alt="" /></div>
                </div>


            </footer>

    </div>
</body>
</html>
