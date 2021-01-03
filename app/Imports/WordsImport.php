<?php

namespace App\Imports;

use App\Models\Word;
use Maatwebsite\Excel\Concerns\ToModel;

class WordsImport implements ToModel
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
        return new Word([
            'lesson_id' => $this->id,
            'word' => $row[0],
            'pronounce' => $row[1],
            'type' => $row[2]
        ]);
    }
}
