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
                <th>Tour</th>
                <tr>
            </thead>
            <tbody>
                <?php
                foreach ($eventos1 as $evento) {
                    echo "<tr>";
                    echo "<td>$evento[0]</td>";
                    echo "<td>$evento[1]</td>";
                    echo "<td>$evento[2]</td>";
                    $query = "SELECT tours.nombre FROM tours WHERE tours.nombre = '$evento[0]'::varchar";
                    $result = $db1 -> prepare($query);
                    $result -> execute();
                    $tours = $result -> fetchAll();

                    foreach($tours as $tour){echo "<td>$tour[0]</td>";};

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>   
    </body>
</html>         
