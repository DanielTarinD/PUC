<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

use App\Models\Empresa;
use App\Models\User;

use Carbon\Carbon;

class EmpresaContralorDataTable extends DataTable
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
            ->editColumn('updated_at', function(Empresa $data) {
                return  Carbon::parse($data->updated_at)->format('d-m-Y');
            })
            ->addColumn('estatus', function(Empresa $data){

                $observada = isset($data->observaciones->contraloria_id);
                $validada = isset($data->observaciones->contraloria_validacion);
                $impresa = isset($data->folio->estatus);

                $estatus =  "<span class='badge bg-warning'>Nueva</span>";

                if($observada){
                    $estatus =  "<span class='badge bg-danger'>Observada</span>";
                }

                if($validada){
                    $estatus =  "<span class='badge bg-green'>Validada</span>";
                }

                if($impresa){
                    $estatus =  "<span class='badge bg-info'>Impresa</span>";
                }


                return $estatus;

            })->addColumn('action', function(Empresa $data){

                    $actionBtn =  "<a href='/contralor/".$data->id."' class='btn btn-xs btn-secondary w-60px me-1' id='acceso' data-id='".$data->id."'>Ver</a>";

                    return $actionBtn;
                })->rawColumns(['action', 'estatus']);
    }


    public function query(Empresa $model)
    {

        return $model->newQuery()
        ->where('estatus', '=', 'V');

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
                        'responsive'   => true,
                        'language'     => [
                            'url'      => url('//cdn.datatables.net/plug-ins/1.11.1/i18n/es-mx.json')],
                        'lengthMenu'   => [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
                        'pageLength'   => 25,
                        'buttons'      => ['excel'],
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
            [ 'data' => 'rfc_empresa', 'name' => 'rfc_empresa', 'title' => 'RFC' ],
            [ 'data' => 'nombre_empresa', 'name' => 'nombre_empresa', 'title' => 'Nombre de la Empresa' ],
            [ 'data' => 'nombre_persona', 'name' => 'nombre_persona', 'title' => 'Nombre de la Persona Física' ],
            [ 'data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Enviado','searchable' => false ],
            [ 'data' => 'estatus', 'name' => 'estatus', 'title' => 'Estatus','className' => 'dt-center', 'orderable' => false ],
            [ 'data' => 'action', 'name' => 'action', 'title' => 'Acciones', 'exportable' => false, 'orderable' => false, 'searchable' => false, 'className' => 'dt-center' ],
        ];
    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Empresas_Contraloria_' . date('YmdHis');
    }


}
