<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Comment extends Pivot
{
    protected $table = 'comments';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        Carbon::setlocale(request('lang') ?? 'es');
        return Carbon::parse($value)->diffForHumans();
    }
}
