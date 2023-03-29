<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class relacionamento extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_do_produto',
        'id_associacao',
        'nome_id_associacao',
        'formula_associacao',
        'nome_formula_associacao'
    ];
}
