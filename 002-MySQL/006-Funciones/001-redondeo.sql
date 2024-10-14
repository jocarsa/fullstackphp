SELECT 
    nombre,
    descripcion,
    precio,
    ROUND(precio*0.21) AS 'impuesto',
    ROUND(precio + precio*0.21) AS 'total'
FROM productos
;