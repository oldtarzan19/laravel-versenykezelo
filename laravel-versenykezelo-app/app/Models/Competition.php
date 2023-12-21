<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = ['nev', 'ev', 'elerheto_nyelvek', 'pontok_jo', 'pontok_rossz', 'pontok_ures'];

}
