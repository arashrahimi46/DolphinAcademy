<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $fillable = ['lesson_id', 'word', 'pronounce', 'type'];

    public function meanings()
    {
        return $this->hasMany(Meaning::class);
    }

    public function wordData()
    {
        return $this->hasMany(WordData::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
