CREATE DATABASE pshop;
USE pshop;

CREATE TABLE usuarios(
id          int(255) auto_increment not null,
nombre      varchar(100) not null,
apellidos   varchar(255) not null,
email       varchar(255) not null,
password    varchar(255) not null,
rol         varchar(255),
imagen      varchar(255),
telefono    varchar(255),
direccion   varchar(255),
cedula      varchar(255),
password_date date not null,
CONSTRAINT pk_usuarios PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE categorias(
id          int(255) auto_increment not null,
nombre      varchar(100) not null,
CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO categorias VALUES(null, 'Cortes');

CREATE TABLE productos(
id             int(255) auto_increment not null,
categoria_id   int(255) not null,
nombre         varchar(100) not null,
descripcion    text, 
precio         float(100,2) not null,
stock          int(255) not null,
oferta         int(255) not null,
fecha          date not null,
imagen         varchar(255),
CONSTRAINT pk_productos PRIMARY KEY (id),
CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDb;

CREATE TABLE servicios(
id             int(255) auto_increment not null,
categoria_id   int(255) not null,
nombre         varchar(100) not null,
descripcion    text, 
precio         float(100,2) not null,
oferta         int(255) not null,
duracion       int(255) not null,
fecha          date not null,
imagen         varchar(255),
CONSTRAINT pk_servicios PRIMARY KEY (id),
CONSTRAINT fk_servicio_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDb;

CREATE TABLE combos(
id             int(255) auto_increment not null,
nombre         varchar(100) not null,
descripcion    text, 
precio         float(100,2) not null,
oferta         int(255) not null,
fecha          date not null,
imagen         varchar(255),
CONSTRAINT pk_combos PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE ordenes(
id             int(255) auto_increment not null,
usuario_id     int(255) not null,
provincia      varchar(100) not null,
canton         varchar(100) not null,
distrito       varchar(100) not null,
localidad      varchar(100) not null,
direccion      varchar(255) not null,
coste          float(200,2) not null,
estado         varchar(20) not null,
fecha          date,
hora           time,
CONSTRAINT pk_ordenes PRIMARY KEY (id),
CONSTRAINT fk_orden_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDb;


CREATE TABLE citas(
id             int(255) auto_increment not null,
usuario_id     int(255) not null,
descripcion    text, 
monto         float(100,2) not null,
fecha          date not null,
hora           varchar(255),
duracion       float(100,2) not null,
telefono_1     varchar(255),
telefono_2     varchar(255),
nombre         varchar(255),
raza           varchar(255),
estado           varchar(255),
CONSTRAINT pk_citas PRIMARY KEY (id)
)ENGINE=InnoDb;

CREATE TABLE agenda(
    id                int(255) auto_increment not null,
    fecha             date not null,
    hora_6am_cita_id  varchar(255),
    hora_7am_cita_id  varchar(255),
    hora_8am_cita_id  varchar(255),
    hora_9am_cita_id  varchar(255),
    hora_10am_cita_id  varchar(255),
    hora_11am_cita_id  varchar(255),
    hora_12am_cita_id  varchar(255),
    hora_1pm_cita_id  varchar(255),
    hora_2pm_cita_id  varchar(255),
    hora_3pm_cita_id  varchar(255),
    hora_4pm_cita_id  varchar(255),
    hora_5pm_cita_id  varchar(255),
    hora_6pm_cita_id  varchar(255),
    CONSTRAINT pk_agenda PRIMARY KEY (id)
)ENGINE=InnoDb;


CREATE TABLE lineas_ordenes_productos(
id             int(255) auto_increment not null,
producto_id    int(255) not null,
orden_id       int(255) not null,
unidades       int(255) not null,
CONSTRAINT pk_lineas_ordenes_productos PRIMARY KEY (id),
CONSTRAINT fk_linea_producto FOREIGN KEY(producto_id) REFERENCES productos(id),
CONSTRAINT fk_linea_orden_producto FOREIGN KEY(orden_id) REFERENCES ordenes(id)
)ENGINE=InnoDb;

CREATE TABLE lineas_ordenes_servicios(
id             int(255) auto_increment not null,
servicio_id    int(255) not null,
orden_id       int(255) not null,
unidades       int(255) not null,
CONSTRAINT pk_lineas_ordenes_servicios PRIMARY KEY (id),
CONSTRAINT fk_linea_servicio_orden FOREIGN KEY(servicio_id) REFERENCES servicios(id),
CONSTRAINT fk_linea_orden_servicio FOREIGN KEY(orden_id) REFERENCES ordenes(id)
)ENGINE=InnoDb;

CREATE TABLE lineas_ordenes_combos(
id             int(255) auto_increment not null,
combo_id    int(255) not null,
orden_id       int(255) not null,
unidades       int(255) not null,
CONSTRAINT pk_lineas_ordenes_combos PRIMARY KEY (id),
CONSTRAINT fk_linea_combo FOREIGN KEY(combo_id) REFERENCES combos(id),
CONSTRAINT fk_linea_orden_combo FOREIGN KEY(orden_id) REFERENCES ordenes(id)
)ENGINE=InnoDb;

CREATE TABLE lineas_citas_servicios(
id             int(255) auto_increment not null,
servicio_id    int(255) not null,
cita_id       int(255) not null,
unidades       int(255) not null,
CONSTRAINT pk_lineas_citas_servicios PRIMARY KEY (id),
CONSTRAINT fk_linea_servicio_cita FOREIGN KEY(servicio_id) REFERENCES servicios(id),
CONSTRAINT fk_linea_cita_servicio FOREIGN KEY(cita_id) REFERENCES citas(id)
)ENGINE=InnoDb;

CREATE TABLE lineas_citas_ordenes(
id             int(255) auto_increment not null,
orden_id    int(255) not null,
cita_id       int(255) not null,
unidades       int(255) not null,
CONSTRAINT pk_lineas_citas_ordenes PRIMARY KEY (id),
CONSTRAINT fk_linea_orden_cita FOREIGN KEY(orden_id) REFERENCES ordenes(id),
CONSTRAINT fk_linea_cita_orden FOREIGN KEY(cita_id) REFERENCES citas(id)
)ENGINE=InnoDb;

CREATE TABLE lineas_combos_servicios(
id             int(255) auto_increment not null,
servicio_id    int(255) not null,
combo_id       int(255) not null,
unidades       int(255) not null,
CONSTRAINT pk_lineas_combos_servicios PRIMARY KEY (id),
CONSTRAINT fk_linea_servicio_combo FOREIGN KEY(servicio_id) REFERENCES servicios(id),
CONSTRAINT fk_linea_combo_servicio FOREIGN KEY(combo_id) REFERENCES combos(id)
)ENGINE=InnoDb;

CREATE TABLE lineas_combos_productos(
id             int(255) auto_increment not null,
producto_id    int(255) not null,
combo_id       int(255) not null,
unidades       int(255) not null,
CONSTRAINT pk_lineas_combos_productos PRIMARY KEY (id),
CONSTRAINT fk_linea_producto_combo FOREIGN KEY(producto_id) REFERENCES productos(id),
CONSTRAINT fk_linea_combo_producto FOREIGN KEY(combo_id) REFERENCES combos(id)
)ENGINE=InnoDb;

