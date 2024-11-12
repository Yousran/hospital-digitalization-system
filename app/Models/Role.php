<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'badge_colour',
        'description',
    ];

    public function users(){
        return $this->belongsToMany(User::class, 'user_role')->withPivot('user_id', 'role_id');
    }
}
