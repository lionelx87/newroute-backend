<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Video;
use App\Models\Phone;
use App\Models\Category;


class Spot extends Model
{
    use HasFactory;


    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
