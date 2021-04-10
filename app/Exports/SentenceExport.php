<?php

namespace App\Exports;

use App\Sentence;
use Maatwebsite\Excel\Concerns\FromCollection;

class SentenceExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Sentence::all();
    }
}
