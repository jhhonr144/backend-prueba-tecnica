# Documentación de la API de Compras

## Productos
### Obtener todos los productos
- **Ruta:** GET /productos
- **Descripción:** Obtiene una lista de todos los productos disponibles en la tienda.

## Ejemplo:
```json
GET /productos
[
    {
        "producto_id": 1,
        "nombre": "Teléfono móvil",
        "descripcion": "Un teléfono inteligente de última generación",
        "precio": "499.99",
        "stock": 50
    },
    {
        "producto_id": 2,
        "nombre": "Laptop",
        "descripcion": "Una laptop potente para trabajo y entretenimiento",
        "precio": "899.99",
        "stock": 30
    }
]
```
## Carrito de Compras
### Agregar producto al carrito
- **Ruta:** POST /carrito/agregar
- **Descripción:** Agrega un producto al carrito de compras del cliente.
- **Parámetros de solicitud:**
  - `producto_id` (integer): ID del producto que se va a agregar al carrito.
  - `cantidad` (integer): Cantidad de unidades del producto a agregar al carrito.

  ## Ejemplo respuesta Correcta:
```json
POST /carrito/agregar
{
    "message": "Producto agregado al carrito"
}
```

### Ver resumen de compra
- **Ruta:** GET /carrito/resumen/{cliente_id}
- **Descripción:** Obtiene un resumen de la compra actual del cliente, incluyendo el listado de productos en el carrito, el subtotal, el costo de envío y el total a pagar.
- **Parámetros de solicitud:**
  - `cliente_id` (integer): ID del cliente para el cual se desea ver el resumen de la compra.

## Ejemplo respuesta Correcta:
```json
POST  /carrito/resumen/1
{
    "productos": [
        {
            "nombre": "Teléfono móvil",
            "precio": "499.99",
            "cantidad": 2,
            "subtotal": 999.98
        }
    ],
    "subtotal": 999.98,
    "costo_envio": 10,
    "total": 1009.98
}
```

## Compra
### Realizar compra
- **Ruta:** POST /carrito/comprar
- **Descripción:** Procesa la compra del cliente, realiza un pedido y actualiza el inventario de productos.
- **Parámetros de solicitud:**
  - `cliente_id` (integer): ID del cliente que realiza la compra.
- **Respuesta exitosa:** Retorna un mensaje de confirmación de compra exitosa.
- **Errores posibles:** Retorna un mensaje de error si no hay suficiente stock disponible para uno o más productos en el carrito.

## Ejemplo respuesta Correcta:
```json
POST  /carrito/comprar
{
    "message": "Compra realizada con éxito."
}
```