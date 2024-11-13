<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'speciality_id',
        'biograph_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
   
    public function biograph(){
        return $this->belongsTo(Biograph::class);
    }

    public function speciality(){
        return $this->belongsTo(Speciality::class);
    }

    public function medicalRecords(){
        return $this->hasMany(MedicalRecord::class);
    }
}
