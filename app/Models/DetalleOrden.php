<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    use HasFactory;

    protected $table = 'detalle_orden';

    protected $primaryKey = 'detalle_id';

    protected $fillable = [
        'orden_id',
        'producto_id',
        'cantidad',
        'subtotal',
    ];

    public function orden()
    {
        return $this->belongsTo(Orden::class, 'orden_id');
    }

}
