create database MoviePass;

use MoviePass;

#drop database moviepass;

create table cuentas(
idCuenta int not null auto_increment ,
email varchar(50) not null,
password varchar(50) not null,
privilegios int default 1,
primary key (idCuenta),
constraint uniq_email unique (email)
);
#drop table cuentas;

create table profiles(
idCuenta int not null,
dni int not null,
nombre varchar(30) not null,
apellido varchar(30) not null,
telefono varchar(30) not null,
direccion varchar(50) not null,
primary key (dni),
constraint fk_idCuenta foreign key (idCuenta) references cuentas(idCuenta),
constraint uniq_email unique (dni)
);
#drop table profiles;

create table generos(
idGenero int not null,
nombre varchar(50),
primary key (idGenero),
constraint uniq_nombre unique (nombre)
);
#truncate table generos;

create table movies(
idMovie int not null,
popularity double not null,
video varchar(50) not null,
posterPath varchar(50) not null,
originalLanguage varchar(30) not null,
title varchar(50) not null,
overview text not null,
releaseData date not null,
enabled boolean,
primary key(idMovie)
);
#select * from movies;

create table moviesxgeneros(
idMovie int not null,
idGenero int not null,
primary key(idMovie , idGenero),
constraint fk_idMovie foreign key (idMovie) references movies(idMovie),
constraint fk_idGenero foreign key (idGenero) references generos(idGenero)
);


#drop table moviesxgeneros;
#drop table movies;

create table cines(
    idCine int not null auto_increment,
    nombre varchar(30) not null,
    capacidad int not null,
    direccion varchar(30) not null,
    precioXentrada int not null,
    constraint pkCine primary key (idCine)

);

#drop table cines;

create table rooms(
    idRoom int not null auto_increment,
    idCine int not null,
    nombre varchar(30) not null,
    capacidad int not null,
    precio int not null,
    primary key (idRoom),
    constraint fk_idCine foreign key (idCine) references cines(idCine)
   
);
#drop table rooms;

create table funciones(
    idFuncion int not null auto_increment,
    idMovie int not null,
    idRoom int not null,
    date varchar(30) not null,
    hour TIME(4),
    constraint fk_idMovief foreign key (idMovie) references movies(idMovie),
    constraint fk_idRoom foreign key (idRoom) references rooms(idRoom),
	primary key (idFuncion)

);
drop table funciones;
