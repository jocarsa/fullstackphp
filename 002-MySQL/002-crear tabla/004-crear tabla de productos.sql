CREATE TABLE productos 
    (
        Identificador INT(10) NOT NULL AUTO_INCREMENT , 
        nombre VARCHAR(100) NULL , 
        descripcion TEXT NULL , 
        precio DECIMAL(10,2) NULL , 
        PRIMARY KEY (`Identificador`)
    ) 
    ENGINE = InnoDB 
    COMMENT = 'En esa tabla guardamos los productos';