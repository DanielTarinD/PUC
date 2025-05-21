<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8"/>
    <title>Refrendos</title>
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

                .page-header {
                    position: fixed;
                    top: 0;
                }

                .page-footer {
                    position: fixed;
                    bottom: 0;
                }

                .page-header, .header-space {
                    height: 250px;

                }

                .page-footer, .footer-space{
                    height: 90px;

                }


                thead {display: table-header-group;}
                tfoot {display: table-footer-group;}

                html, body {
                    width: 215.9mm;
                    height: 279.4mm;
                }

                .tabla{
                    text-align: center;
                    font-size:9px;
                }

                table.tabla th, table.tabla td{
                    border: 1px solid black;
                }

                table{
                    width:100%;
                    table-layout: fixed;
                    overflow-wrap: break-word;
                }

                .page {
                    page-break-after: always;
                }




        }


    </style>
</head>
<body>

        @include('reportes.headerRefrendos')
        @include('reportes.footer')

            <table>
                <thead>
                        <tr>
                            <td>
                                <div class="header-space"></div>
                            </td>
                        </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="page">

                                <table class="tabla" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="30">Num.</th>
                                                <th width="200">Empresa</th>
                                                <th width="200">Representante Legal</th>
                                                <th width="100">Especialidades</th>
                                                <th width="100">Folio</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($refrendos as $refrendo)
                                                            <tr height="45px">
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ ($refrendo->nombre_empresa == 'N/A' ? strtoupper($refrendo->nombre_persona) : strtoupper($refrendo->nombre_empresa))  }} </td>
                                                                <td>{{ ($refrendo->representantes()->exists()? strtoupper($refrendo->representantes->nombre_representante):strtoupper($refrendo->nombre_persona)) }}</td>
                                                                <td>
                                                                    @foreach ( $refrendo->especialidades as $especialidad)

                                                                        @if($loop->last)
                                                                            {{  substr($especialidad->especialidad->nombre, 0, 3) }}
                                                                        @else
                                                                            {{  substr($especialidad->especialidad->nombre, 0, 3) }},
                                                                        @endif

                                                                    @endforeach
                                                                </td>
                                                                <td>{{ $refrendo->folio->folio }}</td>
                                                            </tr>
                                            @endforeach
                                        </tbody>
                                </table>





                            </div>
                        </td>
                    </tr>
                </tbody>

                <tfoot>
                    <tr>
                        <td>
                            <div class="footer-space">&nbsp;</div>
                        </td>
                    </tr>
                </tfoot>
            </table>


</body>
</html>
