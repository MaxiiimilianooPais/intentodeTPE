<?php

const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'libreria';
const DB_HOST = 'localhost';

function getConnection() {
    try {
        $connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;

    } catch (PDOException $e) {
        if($e->getCode() == 1049){
            try {
                $connection = new PDO("mysql:host=".DB_HOST, DB_USER, DB_PASS);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Crear la base de datos
                $sql = "CREATE DATABASE IF NOT EXISTS ".DB_NAME;
                $connection->exec($sql);

                // Seleccionar la base de datos
                $connection->exec("USE ".DB_NAME);

                // Crear tabla usuario
                $sql = "CREATE TABLE IF NOT EXISTS usuario (
                        ID_Usuario int(11) NOT NULL AUTO_INCREMENT,
                        Nombre varchar(50) NOT NULL,
                        Password varchar(60) NOT NULL,
                        es_admin tinyint(1) DEFAULT 0,
                        PRIMARY KEY (ID_Usuario)
                    )";
                $connection->exec($sql);

                // Crear tabla libro
                $sql = "CREATE TABLE IF NOT EXISTS libros (
                        ID_Libro int(11) NOT NULL AUTO_INCREMENT,
                        Titulo varchar(50) NOT NULL,
                        Autor varchar(50) NOT NULL,
                        Genero varchar(250) NOT NULL,
                        Editorial varchar(50) NOT NULL,
                        Precio double NOT NULL,
                        PRIMARY KEY (ID_Libro)
                    )";
                $connection->exec($sql);

                return $connection;
            } catch (PDOException $e) {
                die("Error al crear la base de datos: " . $e->getMessage());
            }
        } else {
            die("Error en la conexión: " . $e->getMessage());
        }
    }
}
