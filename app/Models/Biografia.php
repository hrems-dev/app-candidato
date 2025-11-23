<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biografia extends Model
{
    protected $table = 'biografias';
    protected $fillable = ['contenido', 'imagen'];
}
