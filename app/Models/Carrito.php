<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carrito_compras';

    protected $fillable = ['cliente_id', 'producto_id', 'cantidad'];

    public $timestamps = false;
}