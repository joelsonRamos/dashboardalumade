<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pedido extends Model
{
    use HasFactory;
    protected $table = 'pedidos';
    protected $fillable = [
        'id',
        'id_produto',
        'status'
    ];
    public function produto(){
        return $this->belongsTo('App\Models\produto');
    }
}
