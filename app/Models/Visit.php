<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Visit extends Pivot
{
    protected $table = 'visits';
}
