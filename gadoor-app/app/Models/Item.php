<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_item',
        'id_campo',
        'tipo_item',
        'visivel_em',
        'status',
        'deletado',
        'user'
    ];
}
