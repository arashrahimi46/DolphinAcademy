<?php

namespace App\Imports;

use App\Models\Word;
use App\Models\WordLesson;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class WordsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $word = new Word();
            $word->word = $row[0];
            $word->pronounce = $row[1];
            $word->type = $row[2];
            $word->save();
            $word_id = $word->id;
            $lessons = explode(",", $row[3]);
            foreach ($lessons as $lesson) {
                $wordLesson = new WordLesson();
                $wordLesson->word_id = $word_id;
                $wordLesson->lesson_id = $lesson;
                $wordLesson->save();
            }
        }
    }
}
