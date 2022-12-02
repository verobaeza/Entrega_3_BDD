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


    /*--ihn--*/
    $query = "SELECT * FROM tabla_provisoria_propuestas_ignacioh;";
    $result = $db1 -> prepare($query);
    $result = $result -> fetchAll();
    

    /*--ihn--*/

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
                    $query = "SELECT DISTINCT artistas.nombre FROM artistas, evento, presenta_en WHERE artistas.ida = presenta_en.ida AND evento.ide = presenta_en.ide AND 
                    evento.nombre = '$evento[0]'::varchar AND artistas.nombre != '$nombre_artista'::varchar;";
                    $result = $db2 -> prepare($query);
                    $result -> execute();
                    $otros = $result -> fetchAll();
                    $texto = '';
                    foreach($otros as $otro){$texto = "$texto - $otro[0]";};
                    echo "<td>$texto</td>";


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

                    /*--ihn--*/
                    <h3 align="center">Listado de propuestas de eventos hechas por productoras</h3>
                    <?php
                    $query = "SELECT * FROM tabla_ignacio_provisoria_propuestas;";
                    $result = $db1 -> prepare($query);
                    $result -> execute();
                    $dataCollected = $result -> fetchAll();

                    
                    
                    ?>
                    <table>
                        <tr>
                            <th>Nombre</th>
                            <th>Nombre Recinto</th>
                            <th>Ciudad</th>
                            <th>País</th>
                            <th>Capacidad</th>
                        </tr>

                    <?php
                    foreach ($dataCollected as $p) {
                        echo "<tr> <td>$p[0]</td> <td>%p[1]</td> <td>$p[2]</td> <td>$p[3]</td> <td>%p[4]</td> </tr>";
                    }
                    ?>

                    <?php
                    /*ihn: require ya no se deberia colocar porque esta escrito antes*/
                    $query = "SELECT DISTINCT id FROM tabla_ignacio_provisoria_propuestas;";
                    $result = $db -> prepare($query);
                    $result -> execute();
                    $dataCollected = $result -> fetchAll();
                    ?>


                    <form align="center" method="post">
                        ¿Qué evento desea aceptar?:
                        <select name="id">
                            <?php
                            foreach ($dataCollected as $d) {
                                echo "<option value=$d[0]>$d[0]</option>";
                            }
                            ?>
                        </select>
                        <br><br>
                        <input type="submit" value="Aceptar este evento">
                    </form>
                    
                    
                    <form align="center" method="post">
                        ¿Qué evento desea rechazar?:
                        <select name="id">
                            <?php
                            foreach ($dataCollected as $d) {
                                echo "<option value=$d[0]>$d[0]</option>";
                            }
                            ?>
                        </select>
                        <br><br>
                        <input type="submit" value="Rechazar este evento">
                    </form>



                    


                    </table>

                    

                    /*--ihn--*/


            </tbody>
        </table>   
    </body>
</html>         
