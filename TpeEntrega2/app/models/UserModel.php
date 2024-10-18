<?php
require_once './config.php';

class UserModel {
    public function getUserByEmail($email) {    
        $db = getConnection();
        $query = $db->prepare("SELECT id_usuarios, email, clave_usuario, role FROM usuario WHERE email = ?");
        $query->execute([$email]);
        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}


    
    
