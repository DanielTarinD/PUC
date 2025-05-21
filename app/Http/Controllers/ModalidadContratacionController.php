<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\ModalidadContratacion;

use App\Http\Requests\storeModalidadContratacion;

use DataTables;




class ModalidadContratacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalModalidades = ModalidadContratacion::count();

        return view('catalogos.modalidades.index')->with(compact('totalModalidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('catalogos.modalidades.nueva');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeModalidadContratacion $request)
    {
        ModalidadContratacion::create(request()->all());

        return redirect('/catalogos/modalidades');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModalidadContratacion  $modalidad
     * @return \Illuminate\Http\Response
     */
    public function show(ModalidadContratacion $fuente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModalidadContratacion  $modalidad
     * @return \Illuminate\Http\Response
     */
    public function edit(ModalidadContratacion $modalidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModalidadContratacion $modalidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModalidadContratacion $Modalidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModalidadContratacion  $modalidad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modalidad = ModalidadContratacion::find($id);

        try {
            $modalidad->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1451'){
                return "Hay Obras asociadas a esta Modalidad";
            }else{
                return $e->getMessage();
            }
        }

        return "Registro Eliminado Correctamente";

    }


    public function desactivar($id)
    {

        $modalidad = ModalidadContratacion::find($id);

        if($modalidad->status){
            $modalidad->update(['status'=> '0']);

            return "Modalidad Desactivada";
        }else{
            $modalidad->update(['status'=> '1']);

            return "Modalidad Activada";
        }
    }


    public function getModalidades(Request $request)
    {
            $data = ModalidadContratacion::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function(ModalidadContratacion $data) {
                    if($data->status){
                        return "Habilitado";
                    }else{
                        return "Inhabilitado";
                    }

                })
                ->addColumn('action', function(ModalidadContratacion $data){
                    $actionBtn = "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";
                    if($data->status){
                        $actionBtn .= "<a href='#' class='btn btn-xs btn-gray w-60px me-1' id='habilitar' data-id='".$data->id."'>Desact.</a>";
                    }else{
                        $actionBtn .= "<a href='#' class='btn btn-xs btn-primary w-60px me-1' id='habilitar' data-id='".$data->id."'>Act.</a>";
                    }

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);

    }


}
