<?php
require_once './app/models/LibroModel.php';
require_once './app/models/CategoriaModel.php';

function listarLibros() {
    $libros = LibroModel::getAllLibros();
    require './templates/libro/lista.phtml';
}

function detalleLibro($id) {
    $libro = LibroModel::getLibroById($id);
    require './templates/libro/detalle.phtml';
}

function listarCategorias() {
    $generos = CategoriaModel::getAll();
    require './templates/categorias/lista.phtml';
}

function listarPorCategoria($genero) {
    // Pasa el parámetro $genero al método del modelo
    $libros = CategoriaModel::getLibrosPorCategoria($genero);
    // Pasa el género a la vista para mostrarlo
    require './templates/categorias/porCategoria.phtml';
}