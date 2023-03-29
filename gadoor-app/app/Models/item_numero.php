<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item_numero extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_item',
        'placeholder',
        'limite_min',
        'limite_max',
        'deletado',
        'user'
    ];
}
