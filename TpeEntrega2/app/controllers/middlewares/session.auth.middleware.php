<?php
function sessionAuthMiddleware($res) {
    session_start();
    if (isset($_SESSION['ID_USER'])) {
        $res->user = new stdClass();
        $res->user->id = $_SESSION['ID_USER'];
        $res->user->email = $_SESSION['EMAIL_USER'];
        $res->user->role = $_SESSION['ROLE_USER']; // Agregar el rol aquí
        return;
    }
}

?>