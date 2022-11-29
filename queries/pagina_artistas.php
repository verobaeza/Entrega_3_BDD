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
    $query = "SELECT evento, recinto, fecha_inicio FROM eventos WHERE aid = (SELECT ref_id FROM usuarios WHERE nombre_usuario = '$usuario'::varchar);"; 
    $result = $db1 -> prepare($query); # Nos conectamos a a la BDD impar
    $result -> execute();
    $eventos1 = $result -> fetchAll(); # PRIMER RESULTADO

    // OTROS ARTISTAS QUE PARTICIPAN EN EL EVENTO -------------------------------------------------------------
    // TOUR AL QUE PERTENECE  ---------------------------------------------------------------------------------
    $query = "SELECT nombre FROM tours WHERE nombre = (SELECT evento FROM eventos WHERE aid = (SELECT ref_id FROM usuarios WHERE nombre_usuario = '$usuario'::varchar);)";
    $result = $db1 -> prepare($query); # Nos conectamos a a la BDD impar
    $result -> execute();
    $eventos2 = $result -> fetchAll(); # SEGUNDO RESULTADO

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
                    foreach($eventos2 as $tour){echo "<td>$tour[2]</td>"};
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>   
    </body>
</html>         
