<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Comment extends Pivot
{
    protected $table = 'comments';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
