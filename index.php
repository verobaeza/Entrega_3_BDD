<?php include('./templates/header.html');   ?>
<body>
    <h1 align="center"> Entrega 3 - Bases de Datos </h1>
    <h3 align="center"> Grupos 107 y 116 </h3>
    <br>
    <h3 align="center"> Importar usuarios </h3>
    <form align="center" action="./queries/importar_usuarios.php" method="GET">
        <input class='btn' type="submit" value="Importar">
    </form>
    <br>
    <h3 align="center"> Iniciar sesión </h3>
	<br>
    <form align="center" class="form-signin" role="form" action="./queries/validar_login.php" method="post">
        <input type="text" name="nombre_ingresado" placeholder="Nombre usuario" required autofocus>
        <input type="password" name="clave_ingresada" placeholder="Clave" required>
        <button type="submit" name="login"> Ingresar </button>
    </form>
</body>
</html>