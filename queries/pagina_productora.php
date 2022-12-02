<?php 
include('../templates/header.html');   
session_start();
?>

<body>
    <h1 align="center"> Bienvenid@ a la página para productoras! </h1>
</body>
</html>


<?php

    // Nos conectamos a las bdds
    require("../config/conexion.php");
    include('../templates/header.html');
    $usuario = $_SESSION['nombre_ingresado'];

    // QUERY INICIAL PARA GUARDAR NOMBRE DEL ARTISTA QUE INICIÓ SESIÓN
    $query = "SELECT ref_id FROM usuarios WHERE nombre_usuario = '$usuario'::varchar;";
    $result = $db1 -> prepare($query); # Nos conectamos a a la BDD impar
    $result -> execute();
    $results = $result -> fetchAll(); # PRIMER RESULTADO 
    $id_productora = '';  
    
    foreach($results as $id){
        $id_productora = $id[0];
        }
    $id_productora = trim($id_productora);

    





    $query = "SELECT  nombre, fecha_inicio, fecha_termino FROM evento WHERE idp = '$id_productora';";
    $result = $db2 -> prepare($query); # Nos conectamos a a la BDD impar
    $result -> execute();
    $results = $result -> fetchAll(); # PRIMER RESULTADO 



?>
    <body>  
        <table class='table'>
            <thead>
                <tr>
                <th>Nombre evento</th>
                <th>Fecha Inicio</th>
                <th>Fecha Termino</th>
                <tr>
            </thead>
            <tbody>
                <?php

                foreach($results as $datos){
                    echo "<tr>";
                    echo "<td>pico</td>"; ## nombre
                    echo "<td>$datos[1]</td>"; # fecha inicio
                    #echo "<td>$datos[2]</td>"; # fecha termino
                    echo "</tr>";
                }
                ?>
                
            </tbody>
        </table>   

    </body>

</html> 