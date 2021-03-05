<?php

namespace App\Imports;

use App\Models\MeaningSentence;
use App\Models\Sentence;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class SentencesImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $sentence = new Sentence();
            $sentence->sentence = $row[0];
            $sentence->translate = $row[1];
            $sentence->is_stared = $row[2];
            $sentence->stared_sentence = $row[3];
            $sentence->star_translate = $row[4];
            $sentence->save();
            $meanings = explode(",", $row[5]);
            foreach ($meanings as $meaning) {
                $meaningSentence = new MeaningSentence();
                $meaningSentence->meaning_id = $meaning;
                $meaningSentence->sentence_id = $sentence->id;
                $meaningSentence->save();
            }
        }
    }
}
