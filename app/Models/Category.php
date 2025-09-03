<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // fillable jabrain 1-1 misal: id, name, icon dll
    // guarded semua variable bisa masuk kecuali id 
    protected $guarded = [
        'id'
    ];
}
