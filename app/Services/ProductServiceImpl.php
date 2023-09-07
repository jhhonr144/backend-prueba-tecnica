<?php
namespace App\Services;

use App\Contracts\ProductService;
use App\Models\Producto;

class ProductServiceImpl implements ProductService
{
    public function getAllProducts()
    {
        return Producto::all();
    }
}
