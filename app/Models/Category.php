<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";
    public function parent() {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function children() {
        return $this->hasMany('App\Category', 'parent_id'); //get all subs. NOT RECURSIVE
    }

    public function words(){
        return $this->belongsToMany(Word::class, 'word_lessons' , 'lesson_id');

    }
}
