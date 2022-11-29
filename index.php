<?php include('./templates/header.html');?>
    <body>
        <div class='main'>
            <h1 class='title'>Entrega 3 - Bases de Datos </h1>
            <h3 class='subtitle'> Grupos 107 y 116 </h3>
        <div class='container'>
            <h3>Importar usuarios </h3>
            <form action="./queries/importar_usuarios.php" method="GET">
                <input class='btn' type="submit" value="Importar">
            </form>
        </div>
        <div class='container'>
            <h3> Iniciar sesión </h3>
            <form class="form-signin" role="form" action="./queries/validar_login.php" method="post">
                <input type="text" name="nombre_ingresado" placeholder="Nombre usuario" required autofocus>
                <input type="password" name="clave_ingresada" placeholder="Clave" required>
                <button type="submit" name="login"> Ingresar </button>
            </form>
        </div>
    </body>
</html>