<?php

namespace App\Exports;

use App\Models\Refrendo;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RefrendosExport implements FromView
{
    public function view(): View
    {
        return view('excel.refrendos', [
            'refrendos' => Refrendo::all()
        ]);
    }
}
