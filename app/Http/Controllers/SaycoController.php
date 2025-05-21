<?php
namespace App\Http\Controllers;



use App\Models\Obra;
use App\Models\PresupuestoOriginal;
use App\Models\Fuente;


class SaycoController extends Controller {

    public function pgo() {

        $totalPresupuesto = Obra::sum('monto_original');
        $totalPresupuesto = '$' . number_format($totalPresupuesto, 2);

        $totalDeObras = count(Obra::all());
        $totalDeObrasVerificadas = count(PresupuestoOriginal::all());

        $fuentes = Fuente::oldest()->get();

        return view('direccionGeneral.pgo')->with(compact('fuentes'));


    }




}
