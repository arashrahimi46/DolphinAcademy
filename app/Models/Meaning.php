<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meaning extends Model
{
    use HasFactory;

    protected $fillable = ['meaning', 'synonyms', 'opposites'];

    public function sentences()
    {
        return $this->belongsToMany(Sentence::class, 'meaning_sentences');
    }

    public function meaning()
    {
        return $this->belongsTo(Meaning::class);
    }
}
