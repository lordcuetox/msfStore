/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     31/03/2015 06:56:52 p. m.                    */
/*==============================================================*/


drop index INDEX_1 on CLASIFICACIONES;

drop table if exists CLASIFICACIONES;

drop index INDEX_1 on CLASIFICACIONES_PRODUCTOS;

drop table if exists CLASIFICACIONES_PRODUCTOS;

drop index INDEX_1 on COMUNICACIONES_CLIENTES;

drop table if exists COMUNICACIONES_CLIENTES;

drop index INDEX_1 on DETALLE_PEDIDO;

drop table if exists DETALLE_PEDIDO;

drop index INDEX_1 on EL_REATON;

drop table if exists EL_REATON;

drop index INDEX_1 on GRADOS;

drop table if exists GRADOS;

drop index INDEX_1 on MEDIOS_COMUNICACION;

drop table if exists MEDIOS_COMUNICACION;

drop index INDEX_1 on PEDIDOS;

drop table if exists PEDIDOS;

drop index INDEX_1 on PRODUCTOS;

drop table if exists PRODUCTOS;

drop index INDEX_1 on PROSPECTOS;

drop table if exists PROSPECTOS;

drop index INDEX_1 on RITOS;

drop table if exists RITOS;

/*==============================================================*/
/* Table: CLASIFICACIONES                                       */
/*==============================================================*/
create table CLASIFICACIONES
(
   CVE_RITO             int not null,
   CVE_CLASIFICACION    int not null,
   DESCRIPCION          varchar(50),
   ACTIVO               bool,
   primary key (CVE_CLASIFICACION, CVE_RITO)
);

alter table CLASIFICACIONES comment 'se clasifican en dos 
simbolica
y filosofica';

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on CLASIFICACIONES
(
   CVE_RITO,
   CVE_CLASIFICACION
);

/*==============================================================*/
/* Table: CLASIFICACIONES_PRODUCTOS                             */
/*==============================================================*/
create table CLASIFICACIONES_PRODUCTOS
(
   CVE_RITO             int not null,
   CVE_CLASIFICACION    int not null,
   CVE_GRADO            int not null,
   CVE_CLAS_PRODUCTO    int not null,
   DESCRIPCION          varchar(50),
   ACTIVO               bool,
   primary key (CVE_RITO, CVE_CLASIFICACION, CVE_GRADO, CVE_CLAS_PRODUCTO)
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on CLASIFICACIONES_PRODUCTOS
(
   CVE_RITO,
   CVE_CLASIFICACION,
   CVE_GRADO,
   CVE_CLAS_PRODUCTO
);

/*==============================================================*/
/* Table: COMUNICACIONES_CLIENTES                               */
/*==============================================================*/
create table COMUNICACIONES_CLIENTES
(
   CVE_CLIENTE          int not null,
   CVE_COMUNICACION     int not null,
   CONSECUTIVO_COMUNICACION int not null,
   DATO                 varchar(50),
   ACTIVO               bool,
   primary key (CVE_CLIENTE, CVE_COMUNICACION, CONSECUTIVO_COMUNICACION)
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on COMUNICACIONES_CLIENTES
(
   CVE_CLIENTE,
   CVE_COMUNICACION
);

/*==============================================================*/
/* Table: DETALLE_PEDIDO                                        */
/*==============================================================*/
create table DETALLE_PEDIDO
(
   CVE_CLIENTE          int not null,
   CVE_PEDIDO           int not null,
   CVE_RITO             int not null,
   CVE_CLASIFICACION    int not null,
   CVE_GRADO            int not null,
   CVE_CLAS_PRODUCTO    int not null,
   CVE_PRODUCTO         int not null,
   CANTIDAD             int,
   PRECIO_UNITARIO      float,
   DESCUENTO            bool,
   PRECIO_UNITARIO_DESC float,
   MONTO_TOTAL_PAGAR    float,
   primary key (CVE_CLIENTE, CVE_PEDIDO, CVE_RITO, CVE_CLASIFICACION, CVE_GRADO, CVE_CLAS_PRODUCTO, CVE_PRODUCTO)
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on DETALLE_PEDIDO
(
   CVE_CLIENTE,
   CVE_PEDIDO,
   CVE_RITO,
   CVE_CLASIFICACION,
   CVE_GRADO,
   CVE_CLAS_PRODUCTO
);

/*==============================================================*/
/* Table: EL_REATON                                             */
/*==============================================================*/
create table EL_REATON
(
   CVE_REATA            int not null,
   HABILITADO           varchar(50),
   FRESITA              varchar(50),
   primary key (CVE_REATA)
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on EL_REATON
(
   CVE_REATA
);

/*==============================================================*/
/* Table: GRADOS                                                */
/*==============================================================*/
create table GRADOS
(
   CVE_RITO             int not null,
   CVE_CLASIFICACION    int not null,
   CVE_GRADO            int not null,
   DESCRIPCION          varchar(50),
   ACTIVO               bool,
   primary key (CVE_CLASIFICACION, CVE_RITO, CVE_GRADO)
);

alter table GRADOS comment 'grados de los ritos por clasificacion';

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on GRADOS
(
   CVE_RITO,
   CVE_CLASIFICACION,
   CVE_GRADO
);

/*==============================================================*/
/* Table: MEDIOS_COMUNICACION                                   */
/*==============================================================*/
create table MEDIOS_COMUNICACION
(
   CVE_COMUNICACION     int not null,
   DESCRIPCION          varchar(100),
   ACTIVO               bool,
   primary key (CVE_COMUNICACION)
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on MEDIOS_COMUNICACION
(
   CVE_COMUNICACION
);

/*==============================================================*/
/* Table: PEDIDOS                                               */
/*==============================================================*/
create table PEDIDOS
(
   CVE_CLIENTE          int not null,
   CVE_PEDIDO           int not null,
   REFERENCIA           varchar(20),
   FECHA                datetime,
   STATUS               int,
   MONTO_TOTAL          float,
   FECHA_ACTUALIZACION  datetime,
   NUMERO_GUIA          varchar(50),
   DESCRIPCION_GUIA     varchar(250),
   DIRECCION_ENVIO      varchar(500),
   primary key (CVE_CLIENTE, CVE_PEDIDO)
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on PEDIDOS
(
   CVE_CLIENTE,
   CVE_PEDIDO
);

/*==============================================================*/
/* Table: PRODUCTOS                                             */
/*==============================================================*/
create table PRODUCTOS
(
   CVE_RITO             int not null,
   CVE_CLASIFICACION    int not null,
   CVE_GRADO            int not null,
   CVE_CLAS_PRODUCTO    int not null,
   CVE_PRODUCTO         int not null,
   NOMBRE               varchar(100),
   DESCRIPCION          varchar(300),
   RUTA_IMAGEN1         varchar(50),
   RUTA_IMAGEN2         varchar(50),
   RUTA_IMAGEN3         varchar(50),
   RUTA_IMAGEN4         varchar(50),
   PRECIO               float,
   NOVEDAD              bool,
   FECHA_NOVEDAD        datetime,
   OFERTA               bool,
   FECHA_OFERTA         datetime,
   PRECIO_OFERTA        float,
   EXISTENCIAS          int,
   ACTIVO               bool,
   primary key (CVE_RITO, CVE_CLASIFICACION, CVE_GRADO, CVE_CLAS_PRODUCTO, CVE_PRODUCTO)
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on PRODUCTOS
(
   CVE_RITO,
   CVE_CLASIFICACION,
   CVE_GRADO,
   CVE_CLAS_PRODUCTO,
   CVE_PRODUCTO
);

/*==============================================================*/
/* Table: PROSPECTOS                                            */
/*==============================================================*/
create table PROSPECTOS
(
   CVE_CLIENTE          int not null,
   NOMBRE               varchar(50),
   APELLIDO_PAT         varchar(50),
   APELLIDO_MAT         varchar(50),
   SEXO                 bool,
   FECHA_NAC            datetime,
   FECHA_REGISTRO       datetime,
   HABILITADO           varchar(20) comment 'campo que guarda el usuario del cliente',
   FRESITA              varchar(20) comment 'campo que guardara la contraseña del usuario',
   ACTIVO               bool,
   primary key (CVE_CLIENTE)
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on PROSPECTOS
(
   CVE_CLIENTE
);

/*==============================================================*/
/* Table: RITOS                                                 */
/*==============================================================*/
create table RITOS
(
   CVE_RITO             int not null,
   DESCRIPCION          varchar(50),
   ACTIVO               bool,
   primary key (CVE_RITO)
);

alter table RITOS comment 'CATALOGOS DE RITOS';

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on RITOS
(
   CVE_RITO
);

alter table CLASIFICACIONES add constraint FK_REFERENCE_1 foreign key (CVE_RITO)
      references RITOS (CVE_RITO);

alter table CLASIFICACIONES_PRODUCTOS add constraint FK_REFERENCE_3 foreign key (CVE_CLASIFICACION, CVE_RITO, CVE_GRADO)
      references GRADOS (CVE_CLASIFICACION, CVE_RITO, CVE_GRADO);

alter table COMUNICACIONES_CLIENTES add constraint FK_REFERENCE_5 foreign key (CVE_CLIENTE)
      references PROSPECTOS (CVE_CLIENTE);

alter table COMUNICACIONES_CLIENTES add constraint FK_REFERENCE_6 foreign key (CVE_COMUNICACION)
      references MEDIOS_COMUNICACION (CVE_COMUNICACION);

alter table DETALLE_PEDIDO add constraint FK_REFERENCE_8 foreign key (CVE_CLIENTE, CVE_PEDIDO)
      references PEDIDOS (CVE_CLIENTE, CVE_PEDIDO);

alter table DETALLE_PEDIDO add constraint FK_REFERENCE_9 foreign key (CVE_RITO, CVE_CLASIFICACION, CVE_GRADO, CVE_CLAS_PRODUCTO, CVE_PRODUCTO)
      references PRODUCTOS (CVE_RITO, CVE_CLASIFICACION, CVE_GRADO, CVE_CLAS_PRODUCTO, CVE_PRODUCTO);

alter table GRADOS add constraint FK_REFERENCE_2 foreign key (CVE_CLASIFICACION, CVE_RITO)
      references CLASIFICACIONES (CVE_CLASIFICACION, CVE_RITO);

alter table PEDIDOS add constraint FK_REFERENCE_7 foreign key (CVE_CLIENTE)
      references PROSPECTOS (CVE_CLIENTE);

alter table PRODUCTOS add constraint FK_REFERENCE_4 foreign key (CVE_RITO, CVE_CLASIFICACION, CVE_GRADO, CVE_CLAS_PRODUCTO)
      references CLASIFICACIONES_PRODUCTOS (CVE_RITO, CVE_CLASIFICACION, CVE_GRADO, CVE_CLAS_PRODUCTO);

