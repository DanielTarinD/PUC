<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Throwable;



use App\Models\Fuente;
use App\Models\Ejercicio;
use App\Models\PresupuestoOriginal;
use App\Models\Obra;

use App\Http\Requests\storeFuente;
use App\Models\EntidadEjecutora;
use DataTables;




class FuenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalFuentes = Fuente::count();

        return view('catalogos.fuentes.index')->with(compact('totalFuentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ejercicios = Ejercicio::all();
        $entidadesEjecutoras = EntidadEjecutora::all();

        return view('catalogos.fuentes.nueva')->with(compact('ejercicios', 'entidadesEjecutoras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeFuente $request)
    {
        Fuente::create(request()->all());

        return redirect('/catalogos/fuentes');
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


    public function getFuentes(Request $request)
    {
            $data = Fuente::with('ejercicio', 'entidadEjecutora')->oldest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('techo_presupuestal', function(Fuente $data) {
                    return '$' . number_format($data->techo_presupuestal, 2);
                })
                ->addColumn('action', function(Fuente $data){
                    $actionBtn = "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);

    }

    public function getObrasdeFuente(Request $request)
    {

        $data = Obra::with('modalidadContratacion')->where('fuente_id', '=', $request->id);
        return Datatables::of($data)
            ->addIndexColumn()
            ->editColumn('monto_original', function(Obra $data) {
                return '$' . number_format($data->monto_original, 2);
            })
            ->addColumn('action', function(Obra $data){
                $actionBtn =  "<a href='#' class='btn btn-xs btn-info w-60px me-1' id='info' data-id='".$data->id."'>Info</a>";

                if(PresupuestoOriginal::where('obra_id', '=', $data->id)->exists()){
                    $actionBtn .= "<a href='#' class='btn btn-xs btn-warning w-60px me-1' id='ppto' data-id='".$data->id."'>PPTO</a>";
                }else{
                    $actionBtn .= "<a href='#' class='btn btn-xs btn-primary w-60px me-1' id='ppto' data-id='".$data->id."'>PPTO</a>";
                }

                $actionBtn .= "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }


}
