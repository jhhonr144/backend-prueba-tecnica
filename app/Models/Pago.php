<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    
    protected $table = 'pago';

    protected $primaryKey = 'pago_id';

    protected $fillable = [
        'orden_id',
        'monto',
        'fecha',
        'metodo',
    ];

    public function orden()
    {
        return $this->belongsTo(Orden::class, 'orden_id');
    }
}
