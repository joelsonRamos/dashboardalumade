<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class campo extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_campo',
        'id_etapas',
        'id_produtos',
        'status',
        'deletado',
        'user'

    ];
}
