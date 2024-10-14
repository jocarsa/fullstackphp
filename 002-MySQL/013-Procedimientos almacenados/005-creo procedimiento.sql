DELIMITER //

CREATE PROCEDURE CalculaTotales(IN idpedido INT)
BEGIN
    SELECT 
        SUM(productos.precio * lineaspedido.cantidad) AS subtotal,
        ROUND(SUM(productos.precio * lineaspedido.cantidad)*0.21,2) AS impuesto,
        ROUND(SUM(productos.precio * lineaspedido.cantidad)*1.21,2) AS total
    FROM lineaspedido
    LEFT JOIN pedidos ON lineaspedido.pedidos_fecha = pedidos.Identificador
    LEFT JOIN productos ON lineaspedido.productos_nombre = productos.Identificador
    WHERE pedidos.Identificador = idpedido;
END //

DELIMITER ;