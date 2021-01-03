<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'icon' , 'category_id'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function category(){
        return $this->belongsTo(BaseCategory::class , 'category_id' , 'id');
    }
}
