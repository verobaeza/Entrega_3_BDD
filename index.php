<?php?>
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
    <form  align="center" action='./queries/iniciar_sesion.php' method='POST'>
    <div class='form-element'>
        <label for='name'>Nombre usuario</label>
        <input type='text' name='nombre_usuario' />
    </div>
    <div class='form-element'>
        <label for='name'>Clave</label>
        <input type='text' name='clave' />
    </div>
    <div class='form-element'>
        <input class='btn' type="submit" value="Ingresar">
</body>
</html>