<?php

    // Nos conectamos a las bdds
    require("../config/conexion.php");

    
    $query = "SELECT * FROM artistas;"; # Obtenemos todos los artistas
    $result = $db1 -> prepare($query); # Se conecta a la BDD impar
    $result -> execute();
    $artistas = $result -> fetchAll();

    foreach ($artistas as $artista){
        $query = "SELECT importar_usuarios ($artista[0], $artista[1], 'artista');";
        echo gettype($artista[0]) . "<br>";
        echo gettype($artista[1]) . "<br>";
        echo gettype('artista') . "<br>";
        // Ejecutamos las querys para efectivamente insertar los datos
        
        $result = $db1 -> prepare($query);
        $result -> execute();
        $result -> fetchAll();

    }    
    $query = "SELECT * FROM usuarios;";
    $result = $db1 -> prepare($query);
    $result -> execute();
    $usuarios = $result -> fetchAll();

?>
    <body>  
        <table class='table'>
            <thead>
                <tr>
                <th>user_id</th>
                <th>nombre_usuario</th>
                <th>clave</th>
                <th>tipo</th>    
                <tr>
            </thead>
            <tbody>
                <?php
                foreach ($usuarios as $usuario) {
                    echo "<tr>";
                    echo "<td>$usuario[0]</td>";
                    echo "<td>$usuario[1]</td>";
                    echo "<td>$usuario[2]</td>";
                    echo "<td>$usuario[3]</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>   
    </body>
</html>         
