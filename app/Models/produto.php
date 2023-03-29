<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class produto extends Model
{
    use HasFactory;
    protected $table = 'produtos';
    protected $fillable = [
        'name',
        'price',
        'status',
        'deletado',
        'user'
    ];
    public function pedido(){
        return $this->belongsTo('App\Models\pedido');
    }
}
