<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

     protected $table = 'orden';

    protected $primaryKey = 'orden_id';

    protected $fillable = [
        'cliente_id',
        'fecha',
        'estado',
    ];

    
}
