<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $fillable = ['word', 'pronounce', 'type' , 'description'];

    public function meanings()
    {
        return $this->belongsToMany(Meaning::class, 'word_meanings');
    }


    public function wordData()
    {
        return $this->hasMany(WordData::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'word_lessons');
    }
}
