CREATE DATABASE tienda_proyecto;

USE tienda_proyecto;

CREATE TABLE usuarios(
id int(255) AUTO_INCREMENT not null,
nombre varchar(100) not null,
apellidos varchar (255),
email varchar(255) not null,
password varchar (255) not null,
rol varchar(20),
imagen varchar(255),

CONSTRAINT pk_usuarios PRIMARY KEY(id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDB;

INSERT INTO usuarios VALUES(NULL, 'Admin', 'Admin', 'admin@admin.com', 'contraseña', 'admin', null);


CREATE Table categorias(
id int(255) AUTO_INCREMENT not null,
nombre varchar(100) not null,

CONSTRAINT pk_categorias PRIMARY KEY(id)
}ENGINE=InnoDB;

INSERT INTO categorias VALUES (NULL, 'Manga corta');
INSERT INTO categorias VALUES (NULL, 'Pantalones');
INSERT INTO categorias VALUES (NULL, 'Manga larga');
INSERT INTO categorias VALUES (NULL, 'Sudaderas');

CREATE TABLE productos(
id int(255) AUTO_INCREMENT not null,
categoria_id int(255) not null,
nombre varchar(100) not null,
descripcion text,
precio float(100,2) not null,
stock int(255) not null,
oferta varchar(2),
fecha date not null,
imagen varchar(255),

CONSTRAINT pk_categorias PRIMARY KEY(id),
CONSTRAINT fk_producto_categorias FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDB;

CREATE TABLE pedidos(
id int(255) AUTO_INCREMENT not null,
usuario_id int(255) not null,
departamento varchar(100) not null,
municipio varchar(100) not null,
direccion varchar(255) not null,
coste float(200,2) not null,
estado varchar(20) not null,
fecha date,
hora time,

CONSTRAINT pk_pedidos PRIMARY KEY(id),
CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDB;

CREATE TABLE lineas_pedidos(
id int(255) AUTO_INCREMENT not null,
pedido_id int(255) not null,
producto_id int(255) not null,
unidades int(255) not null,

CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id),
CONSTRAINT fk_linea_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
CONSTRAINT fk_linea_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
)ENGINE=InnoDB;