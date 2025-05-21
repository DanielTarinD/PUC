<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Proveedor;
use App\Models\EntidadEjecutora;

use App\Http\Requests\storeProveedor;

use DataTables;




class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $totalProveedores = Proveedor::count();

        return view('catalogos.proveedores.index')->with(compact('totalProveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entidadesEjecutoras = EntidadEjecutora::all();
        return view('catalogos.proveedores.nueva')->with(compact('entidadesEjecutoras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeProveedor $request)
    {
        Proveedor::create(request()->all());

        return redirect('/catalogos/proveedores');
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
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);

        $proveedor->delete();
        return "Registro Eliminado Correctamente";

    }


    public function getProveedores(Request $request)
    {
            $data = Proveedor::with('entidadEjecutora')->orderBy('id', 'asc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function(Proveedor $data){
                    $actionBtn = "<a href='#' class='btn btn-xs btn-danger w-60px me-1' id='borrar' data-id='".$data->id."'>Borrar</a>";
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);

    }


}
