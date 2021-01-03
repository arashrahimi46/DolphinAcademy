<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meaning extends Model
{
    use HasFactory;

    protected $fillable = ['meaning', 'synonyms', 'opposites',
        'word_id'];

    public function sentences()
    {
        return $this->hasMany(Sentence::class);
    }

    public function meaning()
    {
        return $this->belongsTo(Meaning::class);
    }
}
