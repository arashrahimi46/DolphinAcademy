<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meaning extends Model
{
    use HasFactory;

    protected $fillable = ['meaning', 'synonyms', 'opposites' , 'type' , 'description'];

    public function sentences()
    {
        return $this->belongsToMany(Sentence::class, 'meaning_sentences');
    }

    public function words()
    {
        return $this->belongsToMany(Word::class, 'word_meanings');
    }
}
