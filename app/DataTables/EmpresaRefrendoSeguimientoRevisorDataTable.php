<?php

namespace App\DataTables;


use Yajra\DataTables\Services\DataTable;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;


use App\Models\Empresa;
use App\Models\Refrendo;
use App\Models\ObservacionRefrendo;


use Carbon\Carbon;

class EmpresaRefrendoSeguimientoRevisorDataTable extends DataTable
{



    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        return datatables()
            ->eloquent($query)
            ->editColumn('fecha', function(refrendo $data) {
                return  Carbon::parse($data->updated_at)->format('d-m-Y');
            })
            ->editColumn('empresa.nombre_empresa', function(Refrendo $data) {


                if(strlen($data->empresa->nombre_empresa) > 40){
                    $nombreCorto = substr($data->empresa->nombre_empresa, 0, 20);

                    $nombre = "".$nombreCorto."...<i class='fas fa-circle-info' data-toggle='tooltip' title='".$data->empresa->nombre_empresa."'></i>";

                }else{

                    $nombre = $data->empresa->nombre_empresa;

                }

                return $nombre;

            })
            ->editColumn('empresa.nombre_persona', function(Refrendo $data) {

                if(strlen($data->empresa->nombre_persona) > 40){
                    $nombreCorto = substr($data->empresa->nombre_persona, 0, 20);

                    $nombre = "".$nombreCorto."...<i class='fas fa-circle-info' data-toggle='tooltip' title='".$data->empresa->nombre_persona."'></i>";

                }else{

                    $nombre = $data->empresa->nombre_persona;

                }

                return $nombre;

            })
            ->addColumn('validaciones', function(Refrendo $data){

                if(isset($data->observacionesRefrendos->obras_validacion)){
                    $padronValidacion = 'bg-success';
                }elseif(isset($data->observacionesRefrendos->obras)){
                    $padronValidacion = 'bg-warning';
                }else{
                    $padronValidacion = 'bg-danger';
                }

                if(isset($data->observacionesRefrendos->contraloria_validacion)){
                    $contraloriaValidacion = 'bg-success';
                }elseif(isset($data->observacionesRefrendos->contraloria)){
                    $contraloriaValidacion = 'bg-warning';
                }else{
                    $contraloriaValidacion = 'bg-danger';
                }

                $validacionesBtn = "<span class='badge ". $padronValidacion ."'>P</span> ";
                $validacionesBtn .= "<span class='badge ". $contraloriaValidacion ."'>C</span>";

                return $validacionesBtn;
            })
            ->editColumn('refrendo', function(Refrendo $data) {

                return $data->ejercicio;

            })
            ->editColumn('estatus', function(Refrendo $data) {

                $estatus = $data->estatus;

                switch ($estatus) {
                    case 'N':
                            return "<span class='badge bg-secondary'>Nuevo</span>";
                        break;
                    case 'R':
                            return "<span class='badge bg-warning'>Revisión</span>";
                        break;
                    case 'O':
                            return "<span class='badge bg-danger'>Observado</span>";
                        break;
                    case 'V':
                            return "<span class='badge bg-primary'>Validado</span>";
                        break;
                }


            })
            ->addColumn('action', function(Refrendo $data){


                    $refrendoId = $data->id;

                    $actionBtn =  "<a href='/revisor/refrendos/".$refrendoId."' class='btn btn-xs btn-info w-60px me-1' id='acceso' data-id='".$refrendoId."'>Revisar</a>";


                return $actionBtn;
            })->rawColumns(['empresa.nombre_empresa', 'empresa.nombre_persona', 'validaciones', 'estatus', 'action']);
    }


    public function query(Refrendo $model)
    {

        $user = auth()->user();

        return  Refrendo::with('empresa')->whereHas('observacionesRefrendos', function($q) use ($user) {
            $q->where('obras_id', '=', $user->id);
        })->select(['refrendos.id','refrendos.ejercicio', 'refrendos.estatus', 'empresa_id'])->newQuery();

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {

        return $this->builder()
                    ->setTableId('dataTableEmpresas')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"row"<"col-sm-4"B><"col-sm-3"l><"col-sm-5"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>')
                    ->parameters([
                        'responsive'    => true,
                        'autoWidth'     => false,
                        'language'      => [
                            'url'       => url('//cdn.datatables.net/plug-ins/1.11.1/i18n/es-mx.json')],
                        'lengthMenu'    => [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
                        'pageLength'    => 25,
                        'buttons'       => ['excel'],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {

        return [
            Column::make('empresa.rfc_empresa')
                ->title('RFC Empresa')
                ->footer('RFC Empresa'),
            Column::make('empresa.nombre_empresa')
                ->title('Nombre de la Empresa')
                ->footer('Nombre de la Empresa'),
            Column::make('empresa.nombre_persona')
                ->title('Nombre de la Persona Física')
                ->footer('Nombre de la Persona Física'),
            Column::make('estatus')
                ->title('Estatus')
                ->className('dt-center')
                ->searchable(false)
                ->footer('Estatus'),
            Column::make('validaciones')
                ->title('Validaciones')
                ->className('dt-center')
                ->searchable(false)
                ->footer('Validaciones'),
            Column::make('fecha')
                ->title('Fecha')
                ->className('dt-center')
                ->searchable(false)
                ->footer('Fecha'),
            Column::make('ejercicio')
                ->title('Refrendo')
                ->className('dt-center')
                ->searchable(false)
                ->footer('Refrendo'),
            Column::make('action')
                ->title('Acciones')
                ->className('dt-center')
                ->searchable(false)
                ->orderable(false)
                ->footer('Acciones')
                ->exportable(false)
                ->printable(false)
        ];

    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Empresas_' . date('YmdHis');
    }


}
