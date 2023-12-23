<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;

    protected $fillable = ['verseny_id', 'nev', 'datum'];

    public function participants()
    {
        return $this->hasMany(Participant::class, 'fordulo_id');
    }

}
