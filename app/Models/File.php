<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class File extends Model
{
    protected $fillable = [
        'name',        // Nama file
        'category',    // Kategori file, bisa kosong (nullable)
        'path',        // Path file yang disimpan
        'alt',         // Alt text file, bisa kosong (nullable)
    ];
}
