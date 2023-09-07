<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Producto;

class CarritoController extends Controller
{
    public function agregarProducto(Request $request)
    {
        $clienteId = $request->input('cliente_id');
        $productoId = $request->input('producto_id');
        $cantidad = $request->input('cantidad');

        // Validar y agregar el producto al carrito
        $carrito = Carrito::create([
            'cliente_id' => $clienteId,
            'producto_id' => $productoId,
            'cantidad' => $cantidad,
        ]);

        return response()->json(['message' => 'Producto agregado al carrito']);
    }


    public function verResumenCompra($clienteId)
{
    // Obtener los productos en el carrito 
    $productosEnCarrito = Carrito::where('cliente_id', $clienteId)->get();
    $productos = [];
    $subtotal = 0;

    foreach ($productosEnCarrito as $productoEnCarrito) {
        // Obtener el producto
        $producto = Producto::find($productoEnCarrito->producto_id);

        if ($producto) {
            // Calcular el subtotal 
            $subtotalProducto = $producto->precio * $productoEnCarrito->cantidad;

            // Agregar el producto y su subtotal
            $productos[] = [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => $productoEnCarrito->cantidad,
                'subtotal' => $subtotalProducto,
            ];

            $subtotal += $subtotalProducto;
        }
    }


    $costoEnvio = 10.00; 
    // Calcular el total a pagar
    $total = $subtotal + $costoEnvio;

    return response()->json([
        'productos' => $productos,
        'subtotal' => $subtotal,
        'costo_envio' => $costoEnvio,
        'total' => $total,
    ]);
}
    public function eliminarUnProducto(Request $request){
        $clienteId = $request->input('cliente_id');
        $productoId = $request->input('producto_id');

        Carrito::where('cliente_id', $clienteId)
        ->where('producto_id', $productoId)
        ->delete();

        return response()->json(['message' => 'Producto eliminaro del carrito']);
    }

}
