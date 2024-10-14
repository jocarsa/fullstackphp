SELECT 
    nombre,
    descripcion,
    precio,
    precio % 1 AS 'centimos',
    FLOOR(precio) AS 'euros'
FROM productos
;