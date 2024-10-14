SELECT 
    nombre,
    descripcion,
    precio,
    precio*0.21 AS 'impuesto'
FROM productos
;