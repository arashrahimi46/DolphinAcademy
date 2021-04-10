<?php

namespace App\Exports;

use App\Meaning;
use Maatwebsite\Excel\Concerns\FromCollection;

class MeaningExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Meaning::all();
    }
}
