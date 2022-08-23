<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Video;
use App\Models\Phone;
use App\Models\Category;
use Carbon\Carbon;


class Spot extends Model
{
    use HasFactory;

    protected $appends = ['valoration', 'diff_for_humans'];

    public function getValorationAttribute()
    {
        $query = Valoration::where('spot_id', $this->id);
        $users = $query->count();
        $valoration = $users > 0 ? $query->sum('rating') / $users : 0;
        return [
            'users' => $users,
            'rating' => number_format(round($valoration, 1), 1)
        ];
    }

    public function getCommentsAttribute()
    {
        return Comment::with('user')->where('spot_id', $this->id)->orderBy('created_at', 'desc')->get();
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

    public function getDiffForHumansAttribute($value)
    {
        Carbon::setlocale(request('lang') ?? 'es');
        return Carbon::parse($this->pivot->created_at)->diffForHumans();
    }

}
