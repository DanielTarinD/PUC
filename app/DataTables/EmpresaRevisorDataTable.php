<?php

namespace App\DataTables;


use Yajra\DataTables\Services\DataTable;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;


use App\Models\Empresa;


use Carbon\Carbon;

class EmpresaRevisorDataTable extends DataTable
{


    protected $exportColumns = [
        ['data' => 'rfc_empresa', 'title' => 'RFC'],
    ];

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
            ->editColumn('updated_at', function(Empresa $data) {
                return  Carbon::parse($data->updated_at)->format('d-m-Y');
            })
            ->editColumn('nombre_empresa', function(Empresa $data) {

                if(strlen($data->nombre_empresa) > 40){
                    $nombreCorto = mb_substr($data->nombre_empresa, 0, 20);

                    $nombre = "".$nombreCorto."...<i class='fas fa-circle-info' data-toggle='tooltip' title='".$data->nombre_empresa."'></i>";

                }else{

                    $nombre = $data->nombre_empresa;

                }

                return $nombre;

            })
            ->editColumn('nombre_persona', function(Empresa $data) {

                if(strlen($data->nombre_persona) > 40){
                    $nombreCorto = substr($data->nombre_persona, 0, 20);

                    $nombre = "".$nombreCorto."...<i class='fas fa-circle-info' data-toggle='tooltip' title='".$data->nombre_persona."'></i>";

                }else{

                    $nombre = $data->nombre_persona;

                }

                return $nombre;

            })
            ->editColumn('estatus', function(Empresa $data) {
                switch ($data->estatus) {
                    case 'N':
                            return "<span class='badge bg-secondary'>Incompleta</span>";
                        break;
                    case 'R':
                            return "<span class='badge bg-warning'>Revisión</span>";
                        break;
                    case 'O':
                            return "<span class='badge bg-danger'>Observada</span>";
                        break;
                    case 'V':
                            return "<span class='badge bg-primary'>Validada</span>";
                        break;
                }


            })
            ->addColumn('action', function(Empresa $data){
                if($data->estatus == 'O' || $data->estatus == 'V'){
                    $actionBtn = "<a href='revisor/empresas/ver/".$data->id."' class='btn btn-xs btn-secondary w-60px me-1' id='ver' data-id='".$data->id."'><i class='fa fa-eye'></i></a>";
                }else{
                    $actionBtn =  "<a href='/revisor/".$data->id."' class='btn btn-xs btn-info w-60px me-1' id='acceso' data-id='".$data->id."'>Revisar</a>";
                }


                return $actionBtn;
            })->rawColumns(['action', 'nombre_empresa', 'nombre_persona', 'estatus']);
    }


    public function query(Empresa $model)
    {
        $user = auth()->user();

        return $model->newQuery()
        ->whereIn('estatus', ['N', 'R']);


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
            Column::make('rfc_empresa')
            ->title('RFC Empresa')
                ->footer('RFC Empresa'),
            Column::make('nombre_empresa')
            ->title('Nombre de la Empresa')
                ->footer('Nombre de la Empresa'),
            Column::make('nombre_persona')
            ->title('Nombre de la Persona Física')
                ->footer('Nombre de la Persona Física'),
            Column::make('estatus')
            ->title('Estatus')
                ->className('dt-center')
                ->footer('Estatus')
                ->exportable(false),
            Column::make('updated_at')
            ->title('Modificado')
                ->className('dt-center')
                ->footer('Modificado'),
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
