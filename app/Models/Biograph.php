<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biograph extends Model
{
    public function user(){
        return $this->hasOne(User::class);
    }
}
