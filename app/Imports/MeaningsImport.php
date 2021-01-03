<?php

namespace App\Imports;

use App\Models\Meaning;
use Maatwebsite\Excel\Concerns\ToModel;

class MeaningsImport implements ToModel
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
        return new Meaning([
            'word_id' => $this->id,
            'meaning' => $row[0],
            'synonyms' => $row[1],
            'opposites' => $row[2],
        ]);
    }
}
