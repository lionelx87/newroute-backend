<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Spot;

class Phone extends Model
{
    use HasFactory;

    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }
}
