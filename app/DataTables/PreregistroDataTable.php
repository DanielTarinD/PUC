<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use App\Models\Preregistro;
use App\Models\User;



class PreregistroDataTable extends DataTable
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
            ->addColumn('action', function(Preregistro $data){


                if (User::where('rfc', '=', strtoupper($data->rfc_empresa))->exists()) {
                    $actionBtn =  "<a href='#' class='btn btn-xs btn-secondary w-60px me-1' id='acceso' data-id='".$data->id."'>Ver</a>";
                }else{
                    $actionBtn =  "<a href='#' class='btn btn-xs btn-info w-60px me-1' id='acceso' data-id='".$data->id."'>Acceso</a>";
                }

                $actionBtn .= "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";
                return $actionBtn;
            })->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Preregistro $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Preregistro $model)
    {
        return $model->newQuery()->doesntHave('user');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('dataTablePreregistro')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"row"<"col-sm-4"B><"col-sm-3"l><"col-sm-5"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>')
                    ->parameters([
                        'responsive'   => true,
                        'language'     => [
                            'url'      => url('//cdn.datatables.net/plug-ins/1.11.1/i18n/es-mx.json')],
                        'lengthMenu'   => [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
                        'pageLength'   => 25,
                        'buttons'      => ['excel'],
                    ])
                    ->orderBy(5, 'asc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [ 'data' => 'rfc_empresa', 'name' => 'rfc_empresa', 'title' => 'RFC' ],
            [ 'data' => 'nombre_empresa', 'name' => 'nombre_empresa', 'title' => 'Nombre de la Empresa' ],
            [ 'data' => 'nombre_responsable', 'name' => 'nombre_responsable', 'title' => 'Responsable' ],
            [ 'data' => 'telefono_contacto', 'name' => 'telefono_contacto', 'title' => 'Telefono' ],
            [ 'data' => 'correo_contacto', 'name' => 'correo_contacto', 'title' => 'Correo' ],
            [ 'data' => 'created_at', 'name' => 'created_at', 'title' => 'Preregistro','searchable' => false ],
            [ 'data' => 'action', 'name' => 'action', 'title' => 'Acciones', 'orderable' => false, 'searchable' => false, 'className' => 'dt-center', 'exportable' => false ],
        ];
    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Preregistros_' . date('YmdHis');
    }


}
