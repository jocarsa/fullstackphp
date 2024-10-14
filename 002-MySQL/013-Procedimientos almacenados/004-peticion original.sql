SELECT 
    SUM(productos.precio * lineaspedido.cantidad) AS subtotal,
    SUM(productos.precio * lineaspedido.cantidad)*0.21 AS impuesto,
    SUM(productos.precio * lineaspedido.cantidad)*1.21 AS total
    FROM lineaspedido
    LEFT JOIN pedidos ON lineaspedido.pedidos_fecha = pedidos.Identificador
    LEFT JOIN productos ON lineaspedido.productos_nombre = productos.Identificador
WHERE pedidos.Identificador = 1;