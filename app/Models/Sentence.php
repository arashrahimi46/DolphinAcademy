<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    use HasFactory;

    protected $fillable = ['sentence', 'translate',
        'is_stared', 'stared_sentence', 'star_translate',
        'meaning_id'];

    public function meaning()
    {
        return $this->belongsTo(Meaning::class);
    }
}
