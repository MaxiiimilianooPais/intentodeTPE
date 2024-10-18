<?php
require_once './app/models/LibroModel.php';
require_once './app/models/CategoriaModel.php';
class AdminController {
    public function login()
    {
        if (!isset($_SESSION['admin'])) {
            header('Location: /login');
            exit;
        }   
    }
}

