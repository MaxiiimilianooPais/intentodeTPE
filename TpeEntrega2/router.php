<?php
require_once 'libs/response.php';
require_once './app/controllers/CategoriaController.php';
require_once './app/controllers/AuthController.php';
require_once './app/controllers/LibroController.php';
require_once './app/controllers/middlewares/admin.auth.middleware.php'; 
require_once './app/controllers/middlewares/session.auth.middleware.php';
// Definir base_url para redirecciones y base tag
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$res = new Response();

// Acción por defecto
$action = 'libros';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// Parsear la acción para separar parámetros
$params = explode('/', $action);

// Instancia el controlador
$authController = new AuthController();
$categoriaController = new CategoriaController();
$libroController = new LibroController();

/// Nota: agregue a los ruteos el controlador sessionAuthMiddleware que es el que se encarga de 
// que para ver las cosas hayas iniciado sesión 

switch ($params[0]) {
    // Todo lo relacionado a libros
    case 'libros':
            $libroController->listarLibros();
        break;

    case 'admin':
        // Controlador de administrador
        // Determinar la acción de administración
        switch (isset($params[1]) ? $params[1] : '') {
            case 'login':
                $adminController->login();
                break;
        }
        break;

    case 'eliminarLibro':
        sessionAuthMiddleware($res);
        adminAuthMiddleware($res);
        $libroController->eliminarLibro($params[1]); // Supone que se pasa un ID en la URL
        break;

    case 'detallarLibro':
        sessionAuthMiddleware($res);
        $libroController->detalleLibro($params[1]); // Supone que se pasa un ID en la URL
        break;

    case 'crearLibro':
        sessionAuthMiddleware($res);
        adminAuthMiddleware($res);
        $libroController->crearLibro();
        break;

    case 'editarLibro':
        sessionAuthMiddleware($res);
        adminAuthMiddleware($res);
        $libroController->editarLibro($params[1]);
        break;

    case 'listarCategorias':
        sessionAuthMiddleware($res);
        $categoriaController->listar();
        break;

    case 'librosPorCategoria':
        sessionAuthMiddleware($res);
        $categoriaController->listarPorCategoria($params[1]);
        break;
    case 'editarCategoria':
        sessionAuthMiddleware($res);
        adminAuthMiddleware($res);
        $categoriaController->editarCategoria($params[1]);
        break;
    case 'eliminarCategoria':
        sessionAuthMiddleware($res);
        adminAuthMiddleware($res);
        $categoriaController->eliminarCategoria($params[1]); // Elimina usando el nombre del género
        break;

    case 'showLogin':
        $authController->showLogin();
        break;

    case 'login':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
        

    default:
        echo "404 Page Not Found";
        break;
}
