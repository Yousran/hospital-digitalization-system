<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    public function picture(){
        return $this->belongsTo(File::class);
    }

    public function medicalRecords()
    {
        return $this->belongsToMany(MedicalRecord::class, 'recipe')
                    ->withPivot('quantity', 'description')
                    ->withTimestamps();
    }
}
