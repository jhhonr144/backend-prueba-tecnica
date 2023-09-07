<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto'; 

    protected $primaryKey = 'producto_id'; 

    // Definición de los campos de la tabla
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
    ];

    public $timestamps = false;
	
}