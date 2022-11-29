<?php include('../templates/header.html');   ?>
<body>
    <h1 align="center"> Bienvenid@ a la página para artistas! </h1>
</body>
</html>

<?php

    // Nos conectamos a las bdds
    require("../config/conexion.php");
    include('../templates/header.html');
    $usuario = $_POST['nombre_ingresado'];

    // EVENTOS, FECHAS Y RECINTOS  ----------------------------------------------------------------------------
    $query = "SELECT evento, recinto, fecha_inicio FROM artistas WHERE artista = $_SESSION[];"; # Obtenemos todos los artistas
    $result = $db1 -> prepare($query); # Nos conectamos a a la BDD impar
    $result -> execute();
    $artistas = $result -> fetchAll();