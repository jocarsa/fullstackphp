SELECT * FROM 
pedidos
LEFT JOIN clientes
ON pedidos.clientes_nombre = clientes.Identificador
;