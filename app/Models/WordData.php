<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordData extends Model
{
    use HasFactory;

    protected $fillable = ['word_id', 'key', 'value'];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
