<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lista extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_item',
        'nome_lista',
        'image',
        'tipo_acao',
        'visualizacao',
        'acao',
        'status',
        'deletado',
        'user'
    ];
}
