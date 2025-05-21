<?php

namespace App\DataTables;

use App\Models\Obra;
use App\Models\PresupuestoOriginal;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ObraDataTable extends DataTable
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
            ->addColumn('action', function(Obra $data){
                $actionBtn =  "<a href='#' class='btn btn-xs btn-info w-60px me-1' id='info' data-id='".$data->id."'>Info</a>";

                if(PresupuestoOriginal::where('obra_id', '=', $data->id)->exists()){
                    $actionBtn .= "<a href='#' class='btn btn-xs btn-warning w-60px me-1' id='ppto' data-id='".$data->id."'>PPTO</a>";
                }else{
                    $actionBtn .= "<a href='#' class='btn btn-xs btn-primary w-60px me-1' id='ppto' data-id='".$data->id."'>PPTO</a>";
                }

                $actionBtn .= "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";
                return $actionBtn;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Obra $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Obra $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('dataTableObras')
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
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id', 'nombre', 'action',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Obras_' . date('YmdHis');
    }


    public function Nueva()
    {
        return view('dashboard');
    }
}
