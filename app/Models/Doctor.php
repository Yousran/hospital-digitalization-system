<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
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

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, MedicalRecord::class, 'doctor_id', 'medical_record_id');
    }
}
