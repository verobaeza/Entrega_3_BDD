<?php

    // Nos conectamos a las bdds
    require("../config/conexion.php");

    
    $query = "SELECT * FROM artistas;"; # Obtenemos todos los artistas
    $result = $db1 -> prepare($query); # Se conecta a la BDD impar
    $result -> execute();
    $artistas = $result -> fetchAll();

    foreach ($artistas as $artista){
        $query = "SELECT importar_usuarios ($artista[0], '$artista[1]'::varchar, artista::varchar);";
        // Ejecutamos las querys para efectivamente insertar los datos
        
        $result = $db1 -> prepare($query);
        $result -> execute();
        $result -> fetchAll();

    }    
?>
    
