<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MedicalRecord extends Pivot
{
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'recipe')
                    ->withPivot('quantity', 'description')
                    ->withTimestamps();
    }
}
