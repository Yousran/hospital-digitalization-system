<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'relatives',
        'biograph_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function relative(){
        return $this->belongsTo(User::class, 'relatives');
    }
    
    public function biograph(){
        return $this->belongsTo(Biograph::class);
    }

    public function medicalRecords(){
        return $this->hasMany(MedicalRecord::class);
    }
}
