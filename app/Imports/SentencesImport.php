<?php

namespace App\Imports;

use App\Models\Sentence;
use Maatwebsite\Excel\Concerns\ToModel;

class SentencesImport implements ToModel
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
        return new Sentence([
            'meaning_id' => $this->id,
            'sentence' => $row[0],
            'translate' => $row[1],
            'is_stared' => $row[2],
            'stared_sentence' => $row[3],
            'star_translate' => $row[4],
        ]);
    }
}
