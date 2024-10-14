SELECT 
    Identificador,
    nombre AS 'Nombre del cliente',
    apellidos AS 'Apellidos del cliente',
    email AS 'Correo electrónico del cliente'
FROM clientes
WHERE 
Identificador <= 5
OR
Identificador >=10
;