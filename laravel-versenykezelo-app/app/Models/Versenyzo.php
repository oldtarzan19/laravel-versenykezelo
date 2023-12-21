<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Versenyzo extends Model
{
    use HasFactory;

    protected $fillable = ['felhasznalo_id', 'fordulo_id'];
}
