<?php

namespace App\Imports;

use App\Models\Meaning;
use App\Models\WordMeaning;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class MeaningsImport implements ToCollection
{

    public function model(array $row)
    {
        return new Meaning([
            'meaning' => $row[0],
            'synonyms' => $row[1],
            'opposites' => $row[2],
        ]);
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $meaning = new Meaning();
            $meaning->meaning = $row[0];
            $meaning->synonyms = $row[1];
            $meaning->opposites = $row[2];
            $meaning->save();
            $words = explode(",", $row[3]);
            foreach ($words as $word) {
                $wordMeaning = new WordMeaning();
                $wordMeaning->word_id = $word;
                $wordMeaning->meaning_id = $meaning->id;
                $wordMeaning->save();
            }
        }
    }
}
