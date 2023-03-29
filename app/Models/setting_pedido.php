<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setting_pedido extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pedido',
        'id_produto',
        'id_etapa',
        'id_campo',
        'id_item',
        'item',
    ];
}
