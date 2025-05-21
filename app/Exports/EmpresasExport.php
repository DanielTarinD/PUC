<?php

namespace App\Exports;

use App\Models\Empresa;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class EmpresasExport implements FromView
{
    public function view(): View
    {
        return view('excel.empresas', [
            'empresas' => Empresa::with('estado', 'municipio')->get()
        ]);
    }
}
