SELECT 
    nombre,
    descripcion,
    precio,
    precio*0.21 AS 'impuesto',
    precio + precio*0.21 AS 'total'
FROM productos
;