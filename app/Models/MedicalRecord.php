<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MedicalRecord extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'diagnosis',
        'action',
    ];
    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    
    public function rates(){
        return $this->hasOne(Rate::class);
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'recipes')
                    ->withPivot('quantity', 'description')
                    ->withTimestamps();
    }
}
