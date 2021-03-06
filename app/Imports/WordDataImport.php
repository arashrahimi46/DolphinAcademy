<?php

namespace App\Imports;

use App\Models\WordData;
use Maatwebsite\Excel\Concerns\ToModel;

class WordDataImport implements ToModel
{


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new WordData([
            'key' => $row[0],
            'value' => $row[1],
        ]);
    }
}
