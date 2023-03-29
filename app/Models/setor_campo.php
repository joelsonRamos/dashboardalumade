<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setor_campo extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_setor',
        'id_campo',
    ];
}
