create database senderismo;
use senderismo;

create table rutas (
                       id int(11) primary key ,
                       titulo varchar(55),
                       descripcion blob,
                       desnivel int(6) unsigned,
                       distancia double,
                       notas blob,
                       dificultad smallint(5) unsigned
);

create table rutas_comentarios (
                                   id smallint(6) primary key,
                                   id_ruta int(11),
                                   nombre varchar(50),
                                   texto blob,
                                   fecha date,
                                   foreign key (id_ruta) references rutas(id)
);

create table lista_usuarios (
                                nombreusu varchar(50) not null primary key,
                                rol varchar(5) not null,
                                email varchar(100),
                                password varchar(100) not null
);