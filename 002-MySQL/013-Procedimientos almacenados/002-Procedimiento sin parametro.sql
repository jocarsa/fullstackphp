DELIMITER //

CREATE PROCEDURE DameDetallesPedidos()
BEGIN
    SELECT 
        pedidos.Identificador AS Identificador,
        lineaspedido.cantidad AS cantidad,
        productos.nombre AS nombre,
        productos.precio AS precio,
        productos.precio * lineaspedido.cantidad AS subtotal
    FROM 
        lineaspedido
    LEFT JOIN 
        pedidos ON lineaspedido.pedidos_fecha = pedidos.Identificador
    LEFT JOIN 
        productos ON lineaspedido.productos_nombre = productos.Identificador
    WHERE 
        pedidos.Identificador = 1;
END //

DELIMITER ;
