<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\Obra;
use App\Models\PresupuestoOriginal;

use App\Http\Requests\storePresupuestoOriginal;

class PresupuestoOriginalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('obras/index')->with(compact('ejercicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePresupuestoOriginal $request)
    {

        $obra = Obra::find($request->obra_id);

        $suma = $request->obra_nueva + $request->reparaciones + $request->adaptaciones + $request->mobiliario + $request->prefabricado + $request->otros;

        if($suma <= $obra->monto_original){
            if($request->hasFile('file')){
                $cct = $obra->cct;
                $pgo = $obra->pgo;
                $acuerdo = $obra->acuerdo;
                $anexo = $request->file('file');
                $filename = 'Propuesta-'.$pgo.'.' . $anexo->getClientOriginalExtension();

                $path = $anexo->storeAs(
                    'public/obras/'.$cct.'/'.$acuerdo, $filename
                );

                $presupuestoOriginal = PresupuestoOriginal::create(request()->all());
                $presupuestoOriginal->update(['path' => 'storage/obras/'.$cct.'/'.$acuerdo.'/'.$filename]);

                return redirect('/pgo');
            }

            $presupuestoOriginal = PresupuestoOriginal::create(request()->all());
            return redirect('/pgo');


        }else{
            return Redirect::back()->withErrors(['msg' => 'La Suma de los Conceptos sobrepasa el Monto Original de la Obra.']);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PresupuestoOriginal $ppto
     * @return \Illuminate\Http\Response
     */
    public function show(PresupuestoOriginal $ppto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PresupuestoOriginal $ppto
     * @return \Illuminate\Http\Response
     */
    public function edit(PresupuestoOriginal $ppto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PresupuestoOriginal $ppto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PresupuestoOriginal $ppto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PresupuestoOriginal $ppto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

}
