<?php

class LibreriaView {

    // Mostrar usuarios en una tabla HTML
    public function showUsuarios($usuarios) {
        echo '<h2>Usuarios</h2>';
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>Nombre</th><th>DNI</th></tr>';
        
        foreach ($usuarios as $usuario) {
            echo '<tr>';
            echo '<td>' . $usuario->id_usuarios . '</td>';  // Cambia 'id_usuario' por el nombre correcto
            echo '<td>' . $usuario->nombre_usuario . '</td>';
            echo '<td>' . $usuario->dni_usuario . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    }
}
