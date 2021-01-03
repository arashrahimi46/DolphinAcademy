<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'icon', 'level_id'];

    public function words()
    {
        return $this->hasMany(Word::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
