<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Prpost -> prposts
class Prpost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
    ];
}
