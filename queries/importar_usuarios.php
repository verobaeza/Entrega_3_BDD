<?php

    // Nos conectamos a las bdds
    require("../config/conexion.php");
    include('../templates/header.html');

    // IMPORTAR ARTISTAS ----------------------------------------------------------------------------
    $query = "SELECT * FROM artistas;"; # Obtenemos todos los artistas
    $result = $db1 -> prepare($query); # Nos conectamos a a la BDD impar
    $result -> execute();
    $artistas = $result -> fetchAll();
    $tipo = 'artista';
    $pais = '';

    foreach ($artistas as $artista){
        $query = "SELECT importar_usuarios ($artista[0], '$artista[1]'::varchar, '$tipo'::varchar, '$pais'::varchar);";

        // Ejecutamos las querys para efectivamente insertar los datos
        
        $result = $db1 -> prepare($query);
        $result -> execute();
        $result -> fetchAll();

    }    

    // IMPORTAR PRODUCTORAS ----------------------------------------------------------------------------
    $query = "SELECT * FROM productora;"; # Obtenemos todas las productoras
    $result = $db2 -> prepare($query); # Nos conectamos a la BDD par
    $result -> execute();
    $productoras = $result -> fetchAll();
    $tipo = 'productora';

    foreach($productoras as $productora){
        $query = "SELECT importar_usuarios ($productora[0], '$productora[1]'::varchar, '$tipo'::varchar, '$productora[2]'::varchar);";
        #echo "$productora[0] <br>";
        #echo "$productora[1] <br>";
        #echo "$productora[2] <br>";
        $result = $db1 -> prepare($query);
        $result -> execute();
        $result -> fetchAll();


    }


    # ESTO ES PARA VISUALIZAR SI LA TABLA USUARIOS SE LLENÓ CORRECTAMENTE
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
                    echo "<td>$usuario[4]</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>   
    </body>
</html>         
