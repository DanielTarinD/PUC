<?php

namespace App\Exports;

use App\Models\User;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductividadExport implements FromView
{
    public function view(): View
    {
        return view('excel.productividad', [
            'usuarios' => User::with('observaciones')->role('Revisor')->get()
        ]);
    }
}
