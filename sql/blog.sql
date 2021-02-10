/*Base de datos de la pagina con relaciones 1:1*/
CREATE DATABASE unexpoweb;

USE unexpoweb;

/* Tabla de usuarios de la base de datos */
CREATE TABLE usuarios (
        /* campo del id y es nuestra llave primaria ademas de ser autoincrementable */
	id BIGINT NOT NULL AUTO_INCREMENT UNIQUE, 
	nombre VARCHAR(30) NOT NULL,
	apellido VARCHAR(30) NOT NULL,
	cedula INT(10) NOT NULL UNIQUE,
	expediente INT(10) NOT NULL UNIQUE,
	especialidad VARCHAR(20) NOT NULL,
	email VARCHAR(255) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	fecha_registro DATETIME NOT NULL,
	activo TINYINT NOT NULL,
	PRIMARY KEY(id)
);

/* Tabla de entradas de la base de datos */
CREATE TABLE entradas(
        /* campo del id y es nuestra llave primaria ademas de ser autoincrementable */
        id BIGINT NOT NULL UNIQUE AUTO_INCREMENT,
        /* campo del autor y es nuestra llave foranea que se toma de referencia de la tabla usuarios 
           y el campo id de la misma*/
        autor_id BIGINT NOT NULL,
        url VARCHAR (255) NOT NULL UNIQUE,
        titulo VARCHAR(255) NOT NULL,
        texto TEXT CHARACTER SET utf8 NOT NULL,
        tipo VARCHAR(255) NOT NULL,
        fecha DATETIME NOT NULL,
        activa TINYINT NOT NULL,
        PRIMARY KEY(id),
        FOREIGN KEY(autor_id)
            REFERENCES usuarios(id)
            ON UPDATE CASCADE
            ON DELETE RESTRICT
);

/* Tabla de comentarios de la base de datos */
CREATE TABLE comentarios(
        /* campo del id y es nuestra llave primaria ademas de ser autoincrementable */
        id BIGINT NOT NULL UNIQUE AUTO_INCREMENT,
        /* campo del autor y es nuestra llave foranea que se toma de referencia de la tabla usuarios 
           y el campo id de la misma*/
        autor_id BIGINT NOT NULL,
        /* campo del entrada_id y es nuestra llave foranea que se toma de referencia de la tabla entradas 
           y el campo id de la misma*/
        entrada_id BIGINT NOT NULL,
        titulo VARCHAR(255) NOT NULL,
        texto TEXT CHARACTER SET utf8 NOT NULL,
        fecha DATETIME NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY(autor_id)
            REFERENCES usuarios(id)
            ON UPDATE CASCADE
            ON DELETE RESTRICT,
        FOREIGN KEY(entrada_id)
            REFERENCES entradas(id)
            ON UPDATE CASCADE
            ON DELETE RESTRICT
); 

/* Tabla de tramites de la base de datos */
CREATE TABLE tramites(
        /* campo del id y es nuestra llave primaria ademas de ser autoincrementable */
        id BIGINT NOT NULL UNIQUE AUTO_INCREMENT,
        /* campo del autor y es nuestra llave foranea que se toma de referencia de la tabla usuarios 
           y el campo id de la misma*/
        autor_id BIGINT NOT NULL,
        tipo TEXT CHARACTER SET utf8 NOT NULL,
        fecha DATETIME NOT NULL,
        referencia_tramite INT NOT NULL,
        tramite_activo TINYINT NOT NULL,
        PRIMARY KEY(id),
        FOREIGN KEY(autor_id)
            REFERENCES usuarios(id)
            ON UPDATE CASCADE
            ON DELETE RESTRICT
);

/* Tabla de recuperacion_clave de la base de datos */
CREATE TABLE recuperacion_clave(
        /* campo del id y es nuestra llave primaria ademas de ser autoincrementable */
        id BIGINT NOT NULL UNIQUE AUTO_INCREMENT,
        /* campo del usuario que solicito la recuperacion y es nuestra llave foranea que se toma de referencia de la tabla usuarios 
           y el campo id de la misma*/
        usuario_id BIGINT NOT NULL,
        url_secreta VARCHAR(255) NOT NULL,
        fecha DATETIME NOT NULL,
        PRIMARY KEY(id),
        FOREIGN KEY(usuario_id)
            REFERENCES usuarios(id)
            ON UPDATE CASCADE
            ON DELETE RESTRICT
);