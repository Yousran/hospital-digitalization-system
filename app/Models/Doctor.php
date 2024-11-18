<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'speciality_id',
        'rating',
        'biograph_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
   
    public function biograph(){
        return $this->belongsTo(Biograph::class, 'biograph_id');
    }

    public function speciality(){
        return $this->belongsTo(Speciality::class, 'speciality_id');
    }

    public function medicalRecords(){
        return $this->hasMany(MedicalRecord::class);
    }
}
