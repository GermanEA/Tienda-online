DROP DATABASE IF EXISTS tienda_enseco;
CREATE DATABASE IF NOT EXISTS tienda_enseco;
USE tienda_enseco;

CREATE TABLE IF NOT EXISTS tipo_usuario(
	id_tipo_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS usuario(
	id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),  
    pass VARCHAR(50),
    direccion VARCHAR(100),
    codigo_postal VARCHAR(5),
    telefono INT(9),
    email VARCHAR(100),
    id_tipo_usuario INT NOT NULL,
    CONSTRAINT fk_tipo_u FOREIGN KEY (id_tipo_usuario) REFERENCES tipo_usuario(id_tipo_usuario) ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS tipo_producto(
    id_tipo_producto INT AUTO_INCREMENT PRIMARY KEY,
    tipo_producto VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS talla(
    id_talla INT AUTO_INCREMENT PRIMARY KEY,
    codigo_talla VARCHAR(5)
);

CREATE TABLE IF NOT EXISTS producto(
	id_producto INT AUTO_INCREMENT PRIMARY KEY,
    codigo_producto VARCHAR(8),
    descripcion VARCHAR(50) NOT NULL,
    id_talla INT,
    precio DECIMAL NOT NULL,
    color VARCHAR(25),
    stock INT NOT NULL,
    imagen VARCHAR(200),
    id_tipo_producto INT,
    CONSTRAINT fk_id_p FOREIGN KEY (id_tipo_producto) REFERENCES tipo_producto(id_tipo_producto) ON DELETE NO ACTION ON UPDATE CASCADE,
    CONSTRAINT fk_id_t FOREIGN KEY (id_talla) REFERENCES talla(id_talla) ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS factura(
    id_factura INT AUTO_INCREMENT PRIMARY KEY,
    codigo_factura VARCHAR(15),
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    cif VARCHAR(9),
    direccion VARCHAR(100),
    codigo_postal VARCHAR(5),
    localidad VARCHAR(50),
    telefono INT(9),
    email VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS envio(
    id_envio INT AUTO_INCREMENT PRIMARY KEY,
    codigo_envio VARCHAR(15),
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    cif VARCHAR(9),
    direccion VARCHAR(100),
    codigo_postal VARCHAR(5),
    localidad VARCHAR(50),
    telefono INT(9),
    email VARCHAR(100),
    id_factura INT,
    CONSTRAINT fk_id_factura_f FOREIGN KEY (id_factura) REFERENCES factura(id_factura) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS venta(
	id_venta INT AUTO_INCREMENT PRIMARY KEY,
	codigo_venta VARCHAR(50),
    fecha_pedido DATE,
    fecha_confirmacion DATE,
    fecha_entrega DATE,
    id_usuario INT,
    id_envio INT,
    enviado VARCHAR(7) CHECK(enviado IN('SI', 'NO', 'ANULADO')),
    CONSTRAINT fk_id_usuario_v FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_id_envio_v FOREIGN KEY (id_envio) REFERENCES envio(id_envio) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS venta_detalle(
    id_venta_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT,
    id_producto INT,
    cantidad INT,
    precio DECIMAL,
    total DECIMAL,
    CONSTRAINT fk_id_venta_v FOREIGN KEY (id_venta) REFERENCES venta(id_venta) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_id_producto_v FOREIGN KEY (id_producto) REFERENCES producto(id_producto) ON DELETE NO ACTION ON UPDATE CASCADE
);

INSERT INTO tipo_usuario VALUES(1, 'Administrador'),
    (2, 'Cliente'),
    (3, 'Anonimo');

INSERT INTO usuario VALUES(0, 'Selu', 'Rodríguez', '1234', '', '', 0, 'ADMIN@ADMIN.ES', 1),
	(0, 'Cliente', 'Cliente', '1234', 'Dirección cliente', '11401', 956157489, 'cliente@cliente.com', 2),
    (0, 'Anonimo', 'Anonimo', '', 'Dirección Anonimo', '11406', 856157489, 'anonimo@anonimo.com', 3),
    (0, 'Germán', 'Estrade', '1234', 'Diego Fernandez Herrera', '11401', 658851367, 'nox_ger@hotmail.com', 2);

INSERT INTO tipo_producto VALUES ('', 'Packs');
INSERT INTO tipo_producto VALUES ('', 'Discos');
INSERT INTO tipo_producto VALUES ('', 'Camisetas');
INSERT INTO tipo_producto VALUES ('', 'Sudaderas');
INSERT INTO tipo_producto VALUES ('', 'Gorras');
INSERT INTO tipo_producto VALUES ('', 'Otros');

INSERT INTO talla VALUES (1, 'S');
INSERT INTO talla VALUES (2, 'M');
INSERT INTO talla VALUES (3, 'L');
INSERT INTO talla VALUES (4, 'XL');
INSERT INTO talla VALUES (5, 'XXL');
INSERT INTO talla VALUES (6, 'XXXL');


INSERT INTO producto VALUES (1, 'DI-EP-DD', 'EP - Dónde dije digo...', NULL, 5, NULL, 0, 'public/assets/img/productos/DI-EP-DD.jpg', 2);
INSERT INTO producto VALUES (2, 'DI-EP-VD', 'EP - Vayáis dónde vayáis...', NULL, 5, NULL, 5, 'public/assets/img/productos/DI-EP-VD.jpg', 2);
INSERT INTO producto VALUES (3, 'DI-LP-VD', 'LP - Se nos fue de las manos', NULL, 8, NULL, 5, 'public/assets/img/productos/DI-LP-SE.jpg', 2);

INSERT INTO producto VALUES (4, 'GO-BL-EN', 'Gorra blanca Enseco', NULL, 10.00, 'Azul', 5, 'public/assets/img/productos/GO-BL-EN.jpg', 5);
INSERT INTO producto VALUES (5, 'GO-BL-HE', 'Gorra blanca Héroes', NULL, 10.00, 'Azul', 5, 'public/assets/img/productos/GO-BL-HE.jpg', 5);
INSERT INTO producto VALUES (6, 'GO-NE-BO', 'Gorra negra Bocaseca', NULL, 10.00, 'Azul', 5, 'public/assets/img/productos/GO-NE-BO.jpg', 5);
INSERT INTO producto VALUES (7, 'GO-NE-EN', 'Gorra negra Enseco', NULL, 10.00, 'Azul', 5, 'public/assets/img/productos/GO-NE-EN.jpg', 5);
INSERT INTO producto VALUES (8, 'GO-NE-HE', 'Gorra negra Héroes', NULL, 10.00, 'Azul', 5, 'public/assets/img/productos/GO-NE-HE.jpg', 5);

INSERT INTO producto VALUES (9, 'CA-AZ-HE', 'Camiseta azul Héroes', 3, 10.00, 'Azul', 5, 'public/assets/img/productos/CA-AZ-HE.jpg', 3);
INSERT INTO producto VALUES (10, 'CA-GR-HE', 'Camiseta gris Héroes', 3, 10.00, 'Gris', 5, 'public/assets/img/productos/CA-GR-HE.jpg', 3);
INSERT INTO producto VALUES (11, 'CA-MO-EN', 'Camiseta morada Enseco', 3, 10.00, 'Morado', 5, 'public/assets/img/productos/CA-MO-EN.jpg', 3);
INSERT INTO producto VALUES (12, 'CA-NE-EN', 'Camiseta negra Enseco', 3, 10.00, 'Negro', 5, 'public/assets/img/productos/CA-NE-EN.jpg', 3);
INSERT INTO producto VALUES (13, 'CA-VE-BO', 'Camiseta verde Bocaseca', 3, 10.00, 'Verde', 5, 'public/assets/img/productos/CA-VE-BO.jpg', 3);

INSERT INTO producto VALUES (14, 'SU-GR-HE', 'Sudadera gris Héroes', 3, 10.00, 'Gris', 5, 'public/assets/img/productos/SU-GR-HE.jpg', 4);
INSERT INTO producto VALUES (15, 'SU-MO-EN', 'Sudadera morada Enseco', 3, 10.00, 'Morado', 5, 'public/assets/img/productos/SU-MO-EN.jpg', 4);
INSERT INTO producto VALUES (16, 'SU-NE-EN', 'Sudadera negra Enseco', 3, 10.00, 'Negro', 5, 'public/assets/img/productos/SU-NE-EN.jpg', 4);
INSERT INTO producto VALUES (17, 'SU-RO-HE', 'Sudadera roja Héroes', 3, 10.00, 'Rojo', 5, 'public/assets/img/productos/SU-RO-HE.jpg', 4);

INSERT INTO producto VALUES (18, 'PC-CA-DI', 'Pack camiseta + disco', NULL, 12.00, NULL, 5, 'public/assets/img/productos/PC-CA-DI.jpg', 1);

INSERT INTO producto VALUES (19, 'CH-AZ-FR', 'Chapa logo Frívola', NULL, 1, NULL, 5.00, 'public/assets/img/productos/CH-AZ-FR.jpg', 6);
INSERT INTO producto VALUES (20, 'CH-NE-HL', 'Chapa logo Héroe', NULL, 1, NULL, 5.00, 'public/assets/img/productos/CH-NE-HL.jpg', 6);
INSERT INTO producto VALUES (21, 'CH-NE-PB', 'Chapa logo Paco in black', NULL, 1, NULL, 5.00, 'public/assets/img/productos/CH-NE-PB.jpg', 6);
INSERT INTO producto VALUES (22, 'CH-RO-HE', 'Chapa logo antiguo Enseco', NULL, 1, NULL, 5.00, 'public/assets/img/productos/CH-RO-HE.jpg', 6);
INSERT INTO producto VALUES (23, 'CH-VE-BO', 'Chapa logo Bocaseca', NULL, 1, NULL, 5.00, 'public/assets/img/productos/CH-VE-BO.jpg', 6);
INSERT INTO producto VALUES (24, 'CH-RO-EA', 'Chapa logo Héroes', NULL, 1, NULL, 5.00, 'public/assets/img/productos/CH-RO-EA.jpg', 6);

INSERT INTO producto VALUES ('', 'CA-AZ-HE', 'Camiseta azul Héroes', 4, 10.00, 'Azul', 5, 'public/assets/img/productos/CA-AZ-HE.jpg', 3);
INSERT INTO producto VALUES ('', 'CA-MO-EN', 'Camiseta morada Enseco', 4, 10.00, 'Morado', 5, 'public/assets/img/productos/CA-MO-EN.jpg', 3);
INSERT INTO producto VALUES ('', 'CA-NE-EN', 'Camiseta negra Enseco', 4, 10.00, 'Negro', 5, 'public/assets/img/productos/CA-NE-EN.jpg', 3);

INSERT INTO producto VALUES ('', 'CA-GR-HE', 'Camiseta gris Héroes', 2, 10.00, 'Gris', 5, 'public/assets/img/productos/CA-GR-HE.jpg', 3);
INSERT INTO producto VALUES ('', 'CA-NE-EN', 'Camiseta negra Enseco', 2, 10.00, 'Negro', 5, 'public/assets/img/productos/CA-NE-EN.jpg', 3);
INSERT INTO producto VALUES ('', 'CA-VE-BO', 'Camiseta verde Bocaseca', 2, 10.00, 'Verde', 5, 'public/assets/img/productos/CA-VE-BO.jpg', 3);

INSERT INTO producto VALUES ('', 'SU-GR-HE', 'Sudadera gris Héroes', 2, 10.00, 'Gris', 5, 'public/assets/img/productos/SU-GR-HE.jpg', 4);
INSERT INTO producto VALUES ('', 'SU-MO-EN', 'Sudadera morada Enseco', 1, 10.00, 'Morado', 5, 'public/assets/img/productos/SU-MO-EN.jpg', 4);
INSERT INTO producto VALUES ('', 'SU-NE-EN', 'Sudadera negra Enseco', 5, 10.00, 'Negro', 5, 'public/assets/img/productos/SU-NE-EN.jpg', 4);
INSERT INTO producto VALUES ('', 'SU-RO-HE', 'Sudadera roja Héroes', 4, 10.00, 'Rojo', 5, 'public/assets/img/productos/SU-RO-HE.jpg', 4);

ALTER TABLE venta ADD total DECIMAL(12, 2);

ALTER TABLE producto ADD material VARCHAR(50) AFTER descripcion;

ALTER TABLE usuario ADD cif VARCHAR(9) AFTER apellido;

ALTER TABLE usuario ADD localidad VARCHAR(50) AFTER codigo_postal;

UPDATE producto SET material = '100% Algodón' WHERE id_tipo_producto IN (3, 4, 5);

UPDATE usuario SET cif = '31123743M' WHERE id_usuario IN (1, 2, 3, 4);

UPDATE usuario SET localidad = 'Jerez de la Frontera' WHERE id_usuario IN (1, 2, 3, 4);

