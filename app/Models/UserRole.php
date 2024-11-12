<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserRole extends Pivot
{
    protected $fillable = [
        'user_id',
        'role_id',
    ];
}
