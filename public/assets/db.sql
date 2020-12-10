DROP DATABASE IF EXISTS tienda_enseco;
CREATE DATABASE IF NOT EXISTS tienda_enseco;
USE tienda_enseco;

CREATE TABLE IF NOT EXISTS usuario(
	id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),    
    pass VARCHAR(50),
    direccion VARCHAR(100),
    codigo_postal VARCHAR(5),
    telefono INT(9),
    email VARCHAR(100),
    tipo INT NOT NULL
);

CREATE TABLE IF NOT EXISTS producto(
	modelo VARCHAR(8) PRIMARY KEY ,
    tipo_producto VARCHAR(25) NOT NULL CHECK(tipo_producto IN ('CAMISETA', 'SUDADERA', 'GORRA', 'DISCO', 'OTROS', 'PACK')),
    descripcion VARCHAR(50) NOT NULL,
    talla VARCHAR(5),
    precio DECIMAL NOT NULL,
    color VARCHAR(25),
    stock INT NOT NULL,
    imagen VARCHAR(200)
);

CREATE TABLE IF NOT EXISTS venta(
	numero_pedido INT AUTO_INCREMENT PRIMARY KEY,
	codigo_venta VARCHAR(50),
    modelo VARCHAR(8),
    id_usuario INT,
    fecha_pedido DATE,
    fecha_confirmacion DATE,
    fecha_entrega DATE,
    pendiente VARCHAR(2) CHECK(pendiente IN('SI', 'NO')),
    CONSTRAINT fk_modelo_v FOREIGN KEY (modelo) REFERENCES producto(modelo) ON DELETE NO ACTION ON UPDATE CASCADE,
    CONSTRAINT fk_id_usuario_v FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE NO ACTION ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS compra(
	numero_pedido INT AUTO_INCREMENT PRIMARY KEY,
	codigo_compra VARCHAR(50),
    modelo VARCHAR(6),
    id_usuario INT,
    fecha_pedido DATE,
    fecha_confirmacion DATE,
    fecha_entrega DATE,
    CONSTRAINT fk_modelo_c FOREIGN KEY (modelo) REFERENCES producto(modelo) ON DELETE NO ACTION ON UPDATE CASCADE,
    CONSTRAINT fk_id_usuario_c FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE NO ACTION ON UPDATE CASCADE
);

INSERT INTO usuario VALUES(0, 'Selu', 'Rodríguez', '1234', '', '', 0, 'ADMIN@ADMIN.ES', 0),
	(0, 'Cliente', 'Cliente', '1234', 'Dirección cliente', '11401', 956157489, 'cliente@cliente.com', 1),
    (0, 'Proveedor', 'Proveedor', '', 'Dirección Proveedor', '11406', 856157489, 'proveedor@proveedor.com', 2);




INSERT INTO producto VALUES ('DI_EP_DD', 'DISCO', 'EP - Dónde dije digo, digo Enseco...', '', 5, '', 0, 'public/assets/img/camiseta/DI-EP-DD.jpg');
INSERT INTO producto VALUES ('DI-EP-VD', 'DISCO', 'EP - Vayáis, dónde vayáis...', '', 5, '', 5, 'public/assets/img/camiseta/DI-EP-VD.jpg');
INSERT INTO producto VALUES ('DI-LP-VD', 'DISCO', 'LP - Se nos fue de las manos', '', 8, '', 5, 'public/assets/img/camiseta/DI-LP-SE.jpg');

INSERT INTO producto VALUES ('GO-BL-EN', 'GORRA', 'Gorra blanca Enseco', 'L', 10, 'Azul', 5, 'public/assets/img/camiseta/GO-BL-EN.jpg');
INSERT INTO producto VALUES ('GO-BL-HE', 'GORRA', 'Gorra blanca Héroes', 'L', 10, 'Azul', 5, 'public/assets/img/camiseta/GO-BL-HE.jpg');
INSERT INTO producto VALUES ('GO-NE-BO', 'GORRA', 'Gorra negra Bocaseca', 'L', 10, 'Azul', 5, 'public/assets/img/camiseta/GO-NE-BO.jpg');
INSERT INTO producto VALUES ('GO-NE-EN', 'GORRA', 'Gorra negra Enseco', 'L', 10, 'Azul', 5, 'public/assets/img/camiseta/GO-NE-EN.jpg');
INSERT INTO producto VALUES ('GO-NE-HE', 'GORRA', 'Gorra negra Héroes', 'L', 10, 'Azul', 5, 'public/assets/img/camiseta/GO-NE-HE.jpg');

INSERT INTO producto VALUES ('CA-AZ-HE', 'CAMISETA', 'Camiseta azul Héroes', 'L', 10, 'Azul', 5, 'public/assets/img/camiseta/CA-AZ-HE.jpg');
INSERT INTO producto VALUES ('CA-GR-HE', 'CAMISETA', 'Camiseta gris Héroes', 'L', 10, 'Gris', 5, 'public/assets/img/camiseta/CA-GR-HE.jpg');
INSERT INTO producto VALUES ('CA-MO-EN', 'CAMISETA', 'Camiseta morada Enseco', 'L', 10, 'Morado', 5, 'public/assets/img/camiseta/CA-MO-EN.jpg');
INSERT INTO producto VALUES ('CA-NE-EN', 'CAMISETA', 'Camiseta negra Enseco', 'L', 10, 'Negro', 5, 'public/assets/img/camiseta/CA-NE-EN.jpg');
INSERT INTO producto VALUES ('CA-VE-BO', 'CAMISETA', 'Camiseta verde Bocaseca', 'L', 10, 'Verde', 5, 'public/assets/img/camiseta/CA-VE-BO.jpg');

INSERT INTO producto VALUES ('SU-GR-HE', 'SUDADERA', 'Sudadera gris Héroes', 'L', 10, 'Gris', 5, 'public/assets/img/camiseta/SU-GR-HE.jpg');
INSERT INTO producto VALUES ('SU-MO-EN', 'SUDADERA', 'Sudadera morada Enseco', 'L', 10, 'Morado', 5, 'public/assets/img/camiseta/SU-MO-EN.jpg');
INSERT INTO producto VALUES ('SU-NE-EN', 'SUDADERA', 'Sudadera negra Enseco', 'L', 10, 'Negro', 5, 'public/assets/img/camiseta/SU-NE-EN.jpg');
INSERT INTO producto VALUES ('SU-RO-HE', 'SUDADERA', 'Sudadera roja Héroes', 'L', 10, 'Rojo', 5, 'public/assets/img/camiseta/SU-RO-HE.jpg');

INSERT INTO producto VALUES ('PC-CA-DI', 'PACK', 'Pack camiseta + disco', '', 12, '', 5, 'public/assets/img/camiseta/PC-CA-DI.jpg');

INSERT INTO producto VALUES ('CH-AZ-FR', 'OTROS', 'Chapa logo Frívola', '', 1, '', 5, 'public/assets/img/camiseta/CH-AZ-FR.jpg');
INSERT INTO producto VALUES ('CH-NE-HL', 'OTROS', 'Chapa logo Héroe', '', 1, '', 5, 'public/assets/img/camiseta/CH-NE-HL.jpg');
INSERT INTO producto VALUES ('CH-NE-PB', 'OTROS', 'Chapa logo Paco in black', '', 1, '', 5, 'public/assets/img/camiseta/CH-NE-PB.jpg');
INSERT INTO producto VALUES ('CH-RO-HE', 'OTROS', 'Chapa logo antiguo Enseco', '', 1, '', 5, 'public/assets/img/camiseta/CH-RO-HE.jpg');
INSERT INTO producto VALUES ('CH-VE-BO', 'OTROS', 'Chapa logo Bocaseca', '', 1, '', 5, 'public/assets/img/camiseta/CH-VE-BO.jpg');
INSERT INTO producto VALUES ('CH-RO-EA', 'OTROS', 'Chapa logo Héroes', '', 1, '', 5, 'public/assets/img/camiseta/CH-RO-EA.jpg');




INSERT INTO venta VALUES(0, 'AB345', 'CA-AZ-HE', 2, '2020-06-05', '2020-06-05', '', 'Si');
INSERT INTO venta VALUES(0, 'AB346', 'CA-NE-EN', 2, '2020-06-05', '2020-06-05', '2020-06-10', 'No');
INSERT INTO venta VALUES(0, 'AB347', 'CA-VE-BO', 2, '2020-07-05', '2020-07-05', '2020-06-10', 'Si');
INSERT INTO venta VALUES(0, 'AB348', 'CA-VE-BO', 2, '2020-08-05', '2020-08-05', '', 'No');