<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\EntidadEjecutora;

use App\Http\Requests\storeEntidadEjecutora;

use DataTables;




class EntidadEjecutoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalEntidadesEjecutoras = EntidadEjecutora::count();

        return view('catalogos.entidadesEjecutoras.index')->with(compact('totalEntidadesEjecutoras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('catalogos.entidadesEjecutoras.nueva');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeEntidadEjecutora $request)
    {
        EntidadEjecutora::create(request()->all());

        return redirect('/catalogos/entidadesejecutoras');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fuente  $fuente
     * @return \Illuminate\Http\Response
     */
    public function show(Fuente $fuente)
    {


        return view('fuentes.show')->with(compact('fuente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fuente  $fuente
     * @return \Illuminate\Http\Response
     */
    public function edit(Fuente $fuente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fuente $fuente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obra $obra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fuente  $fuente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fuente = Fuente::find($id);

        try {
            $fuente->delete();
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1451'){
                return "Esta Fuente contiene Obras Comprometidas, no puede eliminarse";
            }else{
                return $e->getMessage();
            }
        }

        return "Registro Eliminado Correctamente";

    }


    public function getEntidadesEjecutoras(Request $request)
    {
            $data = EntidadEjecutora::oldest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(EntidadEjecutora $data){
                    $actionBtn = "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);

    }


}
