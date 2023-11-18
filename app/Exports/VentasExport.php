<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;


class VentasExport implements FromView,ShouldAutoSize
{

    use Exportable;

    public function view():View
    {       
        return view('Pages.VentasExport',
        [
            'records'=> $this->records            
        ]);
    }

    public function records($records) {
        $this->records = $records;
        
        return $this;
    }

}
