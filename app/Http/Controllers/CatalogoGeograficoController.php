<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Estado;
use App\Models\Municipio;
use App\Models\Localidad;

class CatalogoGeograficoController extends Controller {

    public function fetchMunicipios(Request $request)
    {
        $data['municipios'] = Municipio::where('estado_id', '=', $request->estado_id)->get(["nombre", "id"]);
        return response()->json($data);
    }

    public function fetchLocalidades(Request $request)
    {
        $data['localidades'] = Localidad::where("municipio_id", '=', $request->municipio_id)->get(["nombre", "id"]);
        return response()->json($data);
    }

}
