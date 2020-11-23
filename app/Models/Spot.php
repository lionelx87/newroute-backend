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

    protected $appends = ['valoration'];

    public function getValorationAttribute()
    {
        $query = Valoration::where('spot_id', $this->id);
        $users = $query->count();
        $valoration = $users > 0 ? $query->sum('rating') / $users : 0;
        return [
            'users' => $users,
            'rating' => ceil($valoration)
        ];
    }


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
