<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Area;
use App\Models\EntidadEjecutora;


use App\Http\Requests\storeArea;

use DataTables;




class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $totalAreas = Area::count();

        return view('catalogos.areas.index')->with(compact('totalAreas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entidadesEjecutoras = EntidadEjecutora::all();
        return view('catalogos.areas.nueva')->with(compact('entidadesEjecutoras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeArea $request)
    {
        Area::create(request()->all());

        return redirect('/catalogos/areas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Area::find($id);

        $area->delete();
        return "Registro Eliminado Correctamente";

    }


    public function getAreas(Request $request)
    {
            $data = Area::with('entidadEjecutora')->orderBy('id', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(Area $data){
                    if($data->id != 1){
                        $actionBtn = "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";
                    }else{
                        $actionBtn = "";
                    }

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);

    }


}
