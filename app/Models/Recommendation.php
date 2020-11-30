<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Recommendation extends Pivot
{
    protected $table = 'recommendations';

    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }
}
