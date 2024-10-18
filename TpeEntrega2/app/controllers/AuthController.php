<?php 
// Incluimos los modelos y vistas necesarios para el controlador
require_once './app/models/UserModel.php';
require_once './app/views/authView.php';

// Definición de la clase AuthController, que manejará la autenticación
class AuthController {
    private $model; // Instancia del modelo de usuario
    private $view;  // Instancia de la vista de autenticación

    // Constructor que inicializa el modelo y la vista
    public function __construct() {
        $this->model = new UserModel(); // Crea una nueva instancia de UserModel
        $this->view = new AuthView();    // Crea una nueva instancia de AuthView
    }

    // Método para mostrar el formulario de login
    public function showLogin() {
        // Muestro el formulario de login llamando a la vista
        return $this->view->showLogin();
    }

    // Método para manejar el proceso de login
    public function login() {
        // Verifica si el campo 'email' está presente y no está vacío
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            return $this->view->showLogin('Falta completar el nombre de usuario');
        }
    
        // Verifica si el campo 'password' está presente y no está vacío
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showLogin('Falta completar la contraseña');
        }
    
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // Obtiene el usuario de la base de datos utilizando el email
        $userFromDB = $this->model->getUserByEmail($email);
    
        // Verificación del usuario y la contraseña
        if ($userFromDB && password_verify($password, $userFromDB->clave_usuario)) {
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->id_usuarios;
            $_SESSION['EMAIL_USER'] = $userFromDB->email;
            $_SESSION['ROLE_USER'] = $userFromDB->role; // Agregar el rol del usuario a la sesión
    
            // Redirige a una página después de iniciar sesión correctamente
            header('Location: ' . BASE_URL . 'libros');
            exit(); // Asegúrate de detener la ejecución
        } else {
            return $this->view->showLogin('Credenciales incorrectas');
        }
    }
    
    

    // Método para cerrar la sesión del usuario
    public function logout() {
        session_start();  // Inicia la sesión buscando la cookie de sesión
        session_destroy(); // Destruye la sesión actual, eliminando la cookie
        // Redirige al usuario a la página principal después de cerrar sesión
        header('Location: ' . BASE_URL);
    }
}
