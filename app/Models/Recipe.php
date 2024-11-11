<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Recipe extends Pivot
{
    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
