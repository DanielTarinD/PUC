<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

use App\Models\Obra;
use App\Models\PresupuestoOriginal;
use App\Models\Fuente;
use App\Models\ModalidadContratacion;

use App\Http\Requests\storeObra;
use App\Http\Requests\storePresupuestoOriginal;

use App\DataTables\ObraDataTable;

use DataTables;


class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ObraDataTable $dataTable)
    {
        $fuentes = Fuente::oldest()->get();

        return $dataTable->render('obras.index')->with(compact('fuentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fuentes = Fuente::all();
        $modalidades = ModalidadContratacion::where('status', '=' , '1')->get();

        return view('obras/nueva')->with(compact('fuentes','modalidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeObra $request)
    {

        $fuente = Fuente::find($request->input('fuente_id'));

        $nuevoComprometido = $fuente->comprometido + $request->input('monto_original');

        if($nuevoComprometido > $fuente->techo_presupuestal){

            return Redirect::back()->withErrors(['msg' => 'El acumulado de la Fuente sobrepasa su Techo Presupuestal.']);

        }else{
            if($request->hasFile('file')){
                $cct = $request->input('cct');
                $acuerdo = $request->input('acuerdo');
                $anexo = $request->file('file');
                $filename = $cct . '.' . $anexo->getClientOriginalExtension();

                $path = $anexo->storeAs(
                    'public/obras/'.$cct.'/'.$acuerdo, $filename
                );

            }

            $obra = Obra::create(request()->all());

            $obra->update(['path' => 'storage/obras/'.$cct.'/'.$acuerdo.'/'.$filename]);

            return redirect('/pgo');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Obra  $obra
     * @return \Illuminate\Http\Response
     */
    public function show(Obra $obra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Obra  $obra
     * @return \Illuminate\Http\Response
     */
    public function edit(Obra $obra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Obra  $obra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obra $obra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Obra  $obra
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obra = Obra::find($id);

        $obra->delete();
        return "Registro Eliminado Correctamente";

    }


    public function getObras(Request $request)
    {
            $data = Obra::with('modalidadContratacion');
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

    public function Nueva()
    {
        $fuentes = Fuente::all();
        $modalidades = ModalidadContratacion::all();

        return view('obras/nueva')->with(compact('fuentes','modalidades'));
    }

    public function getInfoObra($id)
    {
        $obra = Obra::with('fuente', 'modalidadContratacion')->find($id);

        $obra->monto_original = number_format($obra->monto_original, 2);

        return view('modales.infoObra')->with(compact('obra'));


    }

    public function presupuestoOriginal($id_obra)
    {

        $obra = Obra::find($id_obra);

        if(PresupuestoOriginal::where('obra_id', '=', $id_obra)->exists()){
            return view('modales.presupuestoOriginalBloqueado')->with(compact('obra'));
        }else{
            return view('modales.presupuestoOriginal')->with(compact('obra'));
        }

    }
}
