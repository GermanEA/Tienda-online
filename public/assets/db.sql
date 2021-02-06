DROP DATABASE IF EXISTS tienda_enseco;
CREATE DATABASE IF NOT EXISTS tienda_enseco;
USE tienda_enseco;

CREATE TABLE IF NOT EXISTS tipo_usuario(
	id_tipo_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50)
)ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS usuario(
	id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),  
    pass VARCHAR(50),
    cif VARCHAR(9),
    direccion VARCHAR(100),
    codigo_postal VARCHAR(5),
    localidad VARCHAR(50),
    telefono INT(9),
    email VARCHAR(100),
    id_tipo_usuario INT NOT NULL,
    FOREIGN KEY (id_tipo_usuario) REFERENCES tipo_usuario(id_tipo_usuario) ON DELETE NO ACTION ON UPDATE CASCADE
)ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tipo_producto(
    id_tipo_producto INT AUTO_INCREMENT PRIMARY KEY,
    tipo_producto VARCHAR(50)
)ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS talla(
    id_talla INT AUTO_INCREMENT PRIMARY KEY,
    codigo_talla VARCHAR(5)
)ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS producto(
	id_producto INT AUTO_INCREMENT PRIMARY KEY,
    codigo_producto VARCHAR(8),
    descripcion VARCHAR(50) NOT NULL,
    material VARCHAR(50),
    id_talla INT,
    precio DECIMAL NOT NULL,
    color VARCHAR(25),
    stock INT NOT NULL,
    imagen VARCHAR(200),
    id_tipo_producto INT,
    FOREIGN KEY (id_tipo_producto) REFERENCES tipo_producto(id_tipo_producto) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (id_talla) REFERENCES talla(id_talla) ON DELETE NO ACTION ON UPDATE CASCADE
)ENGINE=InnoDB CHARSET=utf8;

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
)ENGINE=InnoDB CHARSET=utf8;

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
    FOREIGN KEY (id_factura) REFERENCES factura(id_factura) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS venta(
	id_venta INT AUTO_INCREMENT PRIMARY KEY,
	codigo_venta VARCHAR(50),
    fecha_pedido DATE,
    fecha_confirmacion DATE,
    fecha_entrega DATE,
    id_usuario INT,
    id_envio INT,
    enviado VARCHAR(7) CHECK(enviado IN('SI', 'NO', 'ANULADO')),
    total DECIMAL(12, 2),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (id_envio) REFERENCES envio(id_envio) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB CHARSET=utf8;

CREATE TABLE IF NOT EXISTS venta_detalle(
    id_venta_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT,
    id_producto INT,
    cantidad INT,
    precio DECIMAL,
    total DECIMAL,
    FOREIGN KEY (id_venta) REFERENCES venta(id_venta) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (id_producto) REFERENCES producto(id_producto) ON DELETE NO ACTION ON UPDATE CASCADE
)ENGINE=InnoDB CHARSET=utf8;

INSERT INTO tipo_usuario VALUES(1, 'Administrador'),
    (2, 'Gestor pedidos'),
    (3, 'Cliente'),
    (4, 'Anónimo');

INSERT INTO usuario VALUES(0, 'Selu', 'Rodríguez', '1234','31123743M', '', '', 'Jerez de la Frontera', 0, 'admin@admin.ES', 1),
	(0, 'Cliente', 'Cliente', '1234', '31123743M', 'Dirección cliente', '11401', 'Jerez de la Frontera', 956157489, 'cliente@cliente.com', 3),
    (0, 'Anonimo', 'Anonimo', '', '31123743M', 'Dirección Anonimo', '11406', 'Jerez de la Frontera', 856157489, 'anonimo@anonimo.com', 4),
    (0, 'Germán', 'Estrade', '1234', '31123743M', 'Diego Fernandez Herrera', '11401', 'Jerez de la Frontera', 658851367, 'nox_ger@hotmail.com', 2);

INSERT INTO tipo_producto VALUES (0, 'Packs');
INSERT INTO tipo_producto VALUES (0, 'Discos');
INSERT INTO tipo_producto VALUES (0, 'Camisetas');
INSERT INTO tipo_producto VALUES (0, 'Sudaderas');
INSERT INTO tipo_producto VALUES (0, 'Gorras');
INSERT INTO tipo_producto VALUES (0, 'Otros');

INSERT INTO talla VALUES (1, 'S');
INSERT INTO talla VALUES (2, 'M');
INSERT INTO talla VALUES (3, 'L');
INSERT INTO talla VALUES (4, 'XL');
INSERT INTO talla VALUES (5, 'XXL');
INSERT INTO talla VALUES (6, 'XXXL');


INSERT INTO producto VALUES (1, 'DI-EP-DD', 'EP - Dónde dije digo...', NULL, NULL, 5, NULL, 0, 'public/assets/img/productos/DI-EP-DD.jpg', 2);
INSERT INTO producto VALUES (2, 'DI-EP-VD', 'EP - Vayáis dónde vayáis...', NULL, NULL, 5, NULL, 5, 'public/assets/img/productos/DI-EP-VD.jpg', 2);
INSERT INTO producto VALUES (3, 'DI-LP-VD', 'LP - Se nos fue de las manos', NULL, NULL, 8, NULL, 5, 'public/assets/img/productos/DI-LP-SE.jpg', 2);

INSERT INTO producto VALUES (4, 'GO-BL-EN', 'Gorra blanca Enseco', '100% Algodón',  NULL, 10.00, 'Azul', 5, 'public/assets/img/productos/GO-BL-EN.jpg', 5);
INSERT INTO producto VALUES (5, 'GO-BL-HE', 'Gorra blanca Héroes', '100% Algodón', NULL, 10.00, 'Azul', 5, 'public/assets/img/productos/GO-BL-HE.jpg', 5);
INSERT INTO producto VALUES (6, 'GO-NE-BO', 'Gorra negra Bocaseca', '100% Algodón', NULL, 10.00, 'Azul', 5, 'public/assets/img/productos/GO-NE-BO.jpg', 5);
INSERT INTO producto VALUES (7, 'GO-NE-EN', 'Gorra negra Enseco', '100% Algodón', NULL, 10.00, 'Azul', 5, 'public/assets/img/productos/GO-NE-EN.jpg', 5);
INSERT INTO producto VALUES (8, 'GO-NE-HE', 'Gorra negra Héroes', '100% Algodón', NULL, 10.00, 'Azul', 5, 'public/assets/img/productos/GO-NE-HE.jpg', 5);

INSERT INTO producto VALUES (9, 'CA-AZ-HE', 'Camiseta azul Héroes', '100% Algodón', 3, 10.00, 'Azul', 5, 'public/assets/img/productos/CA-AZ-HE.jpg', 3);
INSERT INTO producto VALUES (10, 'CA-GR-HE', 'Camiseta gris Héroes', '100% Algodón', 3, 10.00, 'Gris', 5, 'public/assets/img/productos/CA-GR-HE.jpg', 3);
INSERT INTO producto VALUES (11, 'CA-MO-EN', 'Camiseta morada Enseco', '100% Algodón', 3, 10.00, 'Morado', 5, 'public/assets/img/productos/CA-MO-EN.jpg', 3);
INSERT INTO producto VALUES (12, 'CA-NE-EN', 'Camiseta negra Enseco', '100% Algodón', 3, 10.00, 'Negro', 5, 'public/assets/img/productos/CA-NE-EN.jpg', 3);
INSERT INTO producto VALUES (13, 'CA-VE-BO', 'Camiseta verde Bocaseca', '100% Algodón', 3, 10.00, 'Verde', 5, 'public/assets/img/productos/CA-VE-BO.jpg', 3);

INSERT INTO producto VALUES (14, 'SU-GR-HE', 'Sudadera gris Héroes', '100% Algodón', 3, 10.00, 'Gris', 5, 'public/assets/img/productos/SU-GR-HE.jpg', 4);
INSERT INTO producto VALUES (15, 'SU-MO-EN', 'Sudadera morada Enseco', '100% Algodón', 3, 10.00, 'Morado', 5, 'public/assets/img/productos/SU-MO-EN.jpg', 4);
INSERT INTO producto VALUES (16, 'SU-NE-EN', 'Sudadera negra Enseco', '100% Algodón', 3, 10.00, 'Negro', 5, 'public/assets/img/productos/SU-NE-EN.jpg', 4);
INSERT INTO producto VALUES (17, 'SU-RO-HE', 'Sudadera roja Héroes', '100% Algodón', 3, 10.00, 'Rojo', 5, 'public/assets/img/productos/SU-RO-HE.jpg', 4);

INSERT INTO producto VALUES (18, 'PC-CA-DI', 'Pack camiseta + disco', NULL, NULL, 12.00, NULL, 5, 'public/assets/img/productos/PC-CA-DI.jpg', 1);

INSERT INTO producto VALUES (19, 'CH-AZ-FR', 'Chapa logo Frívola', NULL, NULL, 1, NULL, 5.00, 'public/assets/img/productos/CH-AZ-FR.jpg', 6);
INSERT INTO producto VALUES (20, 'CH-NE-HL', 'Chapa logo Héroe', NULL, NULL, 1, NULL, 5.00, 'public/assets/img/productos/CH-NE-HL.jpg', 6);
INSERT INTO producto VALUES (21, 'CH-NE-PB', 'Chapa logo Paco in black', NULL, NULL, 1, NULL, 5.00, 'public/assets/img/productos/CH-NE-PB.jpg', 6);
INSERT INTO producto VALUES (22, 'CH-RO-HE', 'Chapa logo antiguo Enseco', NULL, NULL, 1, NULL, 5.00, 'public/assets/img/productos/CH-RO-HE.jpg', 6);
INSERT INTO producto VALUES (23, 'CH-VE-BO', 'Chapa logo Bocaseca', NULL, NULL, 1, NULL, 5.00, 'public/assets/img/productos/CH-VE-BO.jpg', 6);
INSERT INTO producto VALUES (24, 'CH-RO-EA', 'Chapa logo Héroes', NULL, NULL, 1, NULL, 5.00, 'public/assets/img/productos/CH-RO-EA.jpg', 6);

INSERT INTO producto VALUES (25, 'CA-AZ-HE', 'Camiseta azul Héroes', '100% Algodón', 4, 10.00, 'Azul', 5, 'public/assets/img/productos/CA-AZ-HE.jpg', 3);
INSERT INTO producto VALUES (26, 'CA-MO-EN', 'Camiseta morada Enseco', '100% Algodón', 4, 10.00, 'Morado', 5, 'public/assets/img/productos/CA-MO-EN.jpg', 3);
INSERT INTO producto VALUES (27, 'CA-NE-EN', 'Camiseta negra Enseco', '100% Algodón', 4, 10.00, 'Negro', 5, 'public/assets/img/productos/CA-NE-EN.jpg', 3);

INSERT INTO producto VALUES (28, 'CA-GR-HE', 'Camiseta gris Héroes', '100% Algodón', 2, 10.00, 'Gris', 5, 'public/assets/img/productos/CA-GR-HE.jpg', 3);
INSERT INTO producto VALUES (29, 'CA-NE-EN', 'Camiseta negra Enseco', '100% Algodón', 2, 10.00, 'Negro', 5, 'public/assets/img/productos/CA-NE-EN.jpg', 3);
INSERT INTO producto VALUES (30, 'CA-VE-BO', 'Camiseta verde Bocaseca', '100% Algodón', 2, 10.00, 'Verde', 5, 'public/assets/img/productos/CA-VE-BO.jpg', 3);

INSERT INTO producto VALUES (31, 'SU-GR-HE', 'Sudadera gris Héroes', '100% Algodón', 2, 10.00, 'Gris', 5, 'public/assets/img/productos/SU-GR-HE.jpg', 4);
INSERT INTO producto VALUES (32, 'SU-MO-EN', 'Sudadera morada Enseco', '100% Algodón', 1, 10.00, 'Morado', 5, 'public/assets/img/productos/SU-MO-EN.jpg', 4);
INSERT INTO producto VALUES (33, 'SU-NE-EN', 'Sudadera negra Enseco', '100% Algodón', 5, 10.00, 'Negro', 5, 'public/assets/img/productos/SU-NE-EN.jpg', 4);
INSERT INTO producto VALUES (34, 'SU-RO-HE', 'Sudadera roja Héroes', '100% Algodón', 4, 10.00, 'Rojo', 5, 'public/assets/img/productos/SU-RO-HE.jpg', 4);


