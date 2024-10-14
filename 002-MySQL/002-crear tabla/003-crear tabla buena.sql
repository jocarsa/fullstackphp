CREATE TABLE clientes 
    (
        Identificador INT(10) NOT NULL AUTO_INCREMENT , 
        nombre VARCHAR(100) NULL , 
        apellidos VARCHAR(150) NULL , 
        email VARCHAR(100) NULL , 
        PRIMARY KEY (`Identificador`)
    ) 
    ENGINE = InnoDB 
    COMMENT = 'En esa tabla guardamos los clientes';