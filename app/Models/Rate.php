<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{

    protected $fillable = [
        'medical_record_id',
        'rate'
    ];
}
