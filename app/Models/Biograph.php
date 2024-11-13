<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biograph extends Model
{
    protected $fillable = [
        'user_id',
        'nik',
        'surename',
        'date_of_birth',
        'gender',
        'address',
        'religion',
        'marriage_status',
        'job',
        'file_id'
    ];
    public function patient(){
        return $this->hasOne(Patient::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
