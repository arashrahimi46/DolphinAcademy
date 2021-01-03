<?php

namespace App\Imports;

use App\Models\WordData;
use Maatwebsite\Excel\Concerns\ToModel;

class WordDataImport implements ToModel
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new WordData([
            'word_id' => $this->id,
            'key' => $row[0],
            'value' => $row[1],
        ]);
    }
}
