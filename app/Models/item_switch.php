<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item_switch extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_item',
        'alternativa_um',
        'alternativa_dois',
        'deletado',
        'user'
    ];
}
