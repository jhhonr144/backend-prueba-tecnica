<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Orden;
use App\Models\DetalleOrden;
use App\Models\Pago;
use Illuminate\Http\JsonResponse;

class CompraController extends Controller
{
    public function realizarCompra(Request $request)
    {
        $clienteId = $request->input('cliente_id');

        $orden = new Orden();
        $orden->cliente_id = $clienteId;
        $orden->fecha = now();
        $orden->estado = 'pendiente';
        $orden->save();

        // Obtener los detalles del carrito 
        $detallesCarrito = Carrito::where('cliente_id', $clienteId)->get();

        foreach ($detallesCarrito as $detalle) {
            // Verificar el stock disponible
            $producto = Producto::find($detalle->producto_id);
            if ($producto && $producto->stock >= $detalle->cantidad) {
                //Crear un nuevo registro en detalle_orden
                $detalleOrden = new DetalleOrden();
                $detalleOrden->orden_id = $orden->orden_id;
                $detalleOrden->producto_id = $detalle->producto_id;
                $detalleOrden->cantidad = $detalle->cantidad;
                $detalleOrden->subtotal = $detalle->cantidad * $producto->precio;
                $detalleOrden->save();

                //Actualizar el inventario del producto
                $producto->stock -= $detalle->cantidad;
                $producto->save();
            } else {
                return new JsonResponse(['message' => 'No hay suficiente stock para uno o más productos.'], 400);
            }
        }

        //  Calcular el monto total
        $total = DetalleOrden::where('orden_id', $orden->orden_id)->sum('subtotal');

        //  Registrar el pago
        $pago = new Pago();
        $pago->orden_id = $orden->orden_id;
        $pago->monto = $total;
        $pago->fecha = now();
        $pago->metodo = 'tarjeta de crédito';
        $pago->save();


        foreach ($detallesCarrito as $detalle) {
            // Eliminar el producto del carrito
            Carrito::where('cliente_id', $clienteId)
                ->where('producto_id', $detalle->producto_id)
                ->delete();
        }

        $orden->estado = 'enviado';
        $orden->save();

        return new JsonResponse(['message' => 'Compra realizada con éxito.'], 200);
    }
}
