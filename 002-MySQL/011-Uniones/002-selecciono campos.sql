SELECT 
pedidos.fecha,
clientes.nombre,
clientes.apellidos,
clientes.email
FROM 
pedidos
LEFT JOIN clientes
ON pedidos.clientes_nombre = clientes.Identificador
;