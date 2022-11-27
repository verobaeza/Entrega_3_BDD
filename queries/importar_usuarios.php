<?php

    // Nos conectamos a las bdds
    require("../config/conexion.php");

    // Primero obtenemos todos los pokemons de la tabla que queremos agregar
    $query = "SELECT * FROM artistas ;";
    $result = $db1 -> prepare($query); # Se conecta a la BDD impar
    $result -> execute();
    $artistas = $result -> fetchAll();

    foreach ($artistas as $artista){
        $query = "SELECT importar_usuarios($artista[0], $artista[1], 'artista');";
    }
    
?>
    
