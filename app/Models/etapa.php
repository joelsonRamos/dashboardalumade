<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class etapa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome_etapa',
        'id_produto',
        'status',
        'deletado',
        'user'
    ];
}
