
<?php
echo '<h2>Filtrar por Género</h2>';
echo '<form method="GET" action="">';  // Manda la petición al controlador actual

// Botón para mostrar todos los libros (sin filtro)
echo '<button type="submit" name="genero" value="">Todos los Géneros</button>';

// Crear un botón por cada género disponible
foreach ($generos as $genero) {
    echo '<button type="submit" name="genero" value="' . $genero . '">' . $genero . '</button>';
}

echo '</form>';

// Tabla para mostrar los libros
echo '<h2>Libros</h2>';
echo '<table border="1">';
echo '<tr><th>ID</th><th>Título</th><th>Género</th><th>Autor</th><th>Precio</th></tr>';

foreach ($libro as $libro) {
    echo '<tr>';
    echo '<td>' . $libro->id_libro . '</td>';
    echo '<td>' . $libro->titulo . '</td>';
    echo '<td>' . $libro->genero . '</td>';
    echo '<td>' . $libro->autor . '</td>';
    echo '<td>' . $libro->precio . '</td>';
    echo '</tr>';
}

echo '</table>';