<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'stock',
        'picture'
    ];
    public function medicinePicture(){
        return $this->belongsTo(File::class, 'picture');
    }

    public function medicalRecords()
    {
        return $this->belongsToMany(MedicalRecord::class, 'recipe')
                    ->withPivot('quantity', 'description')
                    ->withTimestamps();
    }
}
