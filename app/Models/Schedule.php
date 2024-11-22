<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Schedule extends Pivot
{
    protected $table = 'schedule';

    protected $fillable = [
        'doctor_id',
        'patient_id', 
        'date',
        'time',
        'status'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patient() 
    {
        return $this->belongsTo(Patient::class);
    }
}