CREATE DATABASE farmaceutica
drop database farmaceutica

CREATE TABLE clientes (  
    cli_id SERIAL PRIMARY KEY,
    cli_nombres VARCHAR(250) NOT NULL,
    cli_edad INT NOT NULL, 
    cli_dpi INT NOT NULL,
    cli_nit INT NOT NULL,
    cli_telefono INT NOT NULL,
    cli_correo VARCHAR(250) NOT NULL,
    cli_genero VARCHAR(250) NOT NULL,
    cli_direccion VARCHAR(250) NOT NULL,
    cli_situacion SMALLINT DEFAULT 1  
);

CREATE TABLE trabajadores (  
    tra_id SERIAL PRIMARY KEY,
    tra_nombres VARCHAR(250) NOT NULL,
    tra_edad INT NOT NULL, 
    tra_dpi INT NOT NULL,
    tra_puesto VARCHAR(250) NOT NULL,
    tra_telefono INT NOT NULL,
    tra_correo VARCHAR(250) NOT NULL,
    tra_salario INT NOT NULL,
    tra_genero VARCHAR(250) NOT NULL,
    tra_direccion VARCHAR(250) NOT NULL,
    tra_situacion SMALLINT DEFAULT 1  
);



SELECT * FROM clientes


CREATE TABLE casa(
    casa_id SERIAL PRIMARY KEY, 
    casa_nombre VARCHAR(250) NOT NULL, 
    casa_direccion VARCHAR(250) NOT NULL,
    casa_telefono INT NOT NULL,
    casa_jefe VARCHAR(250) NOT NULL, 
    casa_situacion SMALLINT DEFAULT 1
);


CREATE TABLE medicamentos(
    med_id SERIAL PRIMARY KEY, 
    med_nombre VARCHAR(250) NOT NULL, 
    med_vencimiento VARCHAR(250) NOT NULL,
    med_desc VARCHAR(250) NOT NULL,
    med_presentacion VARCHAR(250) NOT NULL,
    med_casa INT NOT NULL,
    med_disponible INT NOT NULL,
    med_precio DECIMAL(10,2) NOT NULL,
    med_situacion SMALLINT DEFAULT 1,
    FOREIGN KEY (med_casa) REFERENCES casa(casa_id)

);



CREATE TABLE venta(
    venta_id SERIAL PRIMARY KEY,
    med_venta INT NOT NULL,
    venta_cant INT NOT NULL,
    med_cliente INT NOT NULL,
    med_tra INT NOT NULL,
    med_situacion SMALLINT DEFAULT 1,
    FOREIGN KEY (med_venta) REFERENCES medicamentos(med_id),
    FOREIGN KEY (med_cliente) REFERENCES clientes(cli_id),
    FOREIGN KEY (med_tra) REFERENCES trabajadores(tra_id)

);

