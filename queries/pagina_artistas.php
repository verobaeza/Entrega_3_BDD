<?php 
include('../templates/header.html');   
session_start();
?>

<body>
    <h1 align="center"> Bienvenid@ a la página para artistas! </h1>
</body>
</html>

<?php

    // Nos conectamos a las bdds
    require("../config/conexion.php");
    include('../templates/header.html');
    $usuario = $_SESSION['nombre_ingresado'];

    // QUERY INICIAL PARA GUARDAR NOMBRE DEL ARTISTA QUE INICIÓ SESIÓN
    $query = "SELECT nombre_artistico FROM artistas WHERE aid = (SELECT ref_id FROM usuarios WHERE nombre_usuario = '$usuario'::varchar)";
    $result = $db1 -> prepare($query); # Nos conectamos a a la BDD impar
    $result -> execute();
    $result = $result -> fetchAll(); # PRIMER RESULTADO 
    $nombre_artista = '';  
    
    foreach($result as $nombre){
        $nombre_artista = $nombre[0];
    }

    // EVENTOS, FECHAS Y RECINTOS  ----------------------------------------------------------------------------
    $query = "SELECT evento, recinto, fecha_inicio FROM eventos WHERE eventos.aid = (SELECT ref_id FROM usuarios WHERE nombre_usuario = '$usuario'::varchar);"; 
    $result = $db1 -> prepare($query); # Nos conectamos a a la BDD impar
    $result -> execute();
    $eventos1 = $result -> fetchAll(); # PRIMER RESULTADO

?>
    <body>  
        <table class='table'>
            <thead>
                <tr>
                <th>Evento</th>
                <th>Recinto</th>
                <th>Fecha inicio</th>
                <th>Otros artistas</th>
                <th>Tour</th>
                <th>Hospedaje</th>
                <tr>
            </thead>
            <tbody>
                <?php
                foreach ($eventos1 as $evento) {
                    echo "<tr>";
                    echo "<td>$evento[0]</td>";
                    echo "<td>$evento[1]</td>";
                    echo "<td>$evento[2]</td>";

                    # evento.fecha_inicio = '$evento[2]'::date 
                    $query = "SELECT artistas.nombre FROM artistas, evento, presenta_en WHERE artistas.ida = presenta_en.ida AND evento.ide = presenta_en.ide AND 
                    evento.nombre = '$evento[0]'::varchar AND artistas.nombre != $nombre_artista;";
                    $result = $db2 -> prepare($query);
                    $result -> execute();
                    $otros = $result -> fetchAll();
                    foreach($otros as $otro){echo "<td> - $otro[0]</td>";};


                    $query = "SELECT nombre FROM tours WHERE nombre = '$evento[0]'::varchar;";
                    $result = $db1 -> prepare($query);
                    $result -> execute();
                    $tours = $result -> fetchAll();
                    foreach($tours as $tour){echo "<td>$tour[0]</td>";};

                    #$query = "SELECT asiento FROM entradas_cortesia WHERE evento = '$evento[0]'::varchar AND aid = (SELECT ref_id FROM usuarios WHERE nombre_usuario = '$usuario'::varchar;)"
                    #$result = $db1 -> prepare($query);
                    #$result -> execute();
                    #$entradas = $result -> fetchAll();               

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>   
    </body>
</html>         
