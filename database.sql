CREATE DATABASE osu;

USE osu;

CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    pwd VARCHAR(255) NOT NULL DEFAULT "password",
    username VARCHAR(255) NOT NULL DEFAULT "Bya"
) ENGINE=InnoDB;

CREATE TABLE tableros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    nombre VARCHAR(255) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE listas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_tablero INT,
    nombre VARCHAR(255) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tablero) REFERENCES tableros(id) ON DELETE CASCADE
);

CREATE TABLE tarjetas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_lista INT,
    titulo VARCHAR(255) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_lista) REFERENCES listas(id) ON DELETE CASCADE
);

INSERT INTO usuarios (pwd, username) VALUES ("hola", "mundo");
SELECT * FROM usuarios;

SELECT * FROM listas;

INSERT INTO tableros (id_usuario, nombre, descripcion) VALUES (9, 'Tablero del Usuario 1', 'Tablero para proyectos del usuario 1');

DELETE FROM usuarios;

CREATE USER 'user'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON osu.* TO 'user'@'localhost';