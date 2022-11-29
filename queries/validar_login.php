<?php
	session_start();
?>

<?php
    require("../config/conexion.php");
    $msg = '';
    if (isset($_POST['login']) && !empty($_POST['nombre_ingresado']) && !empty($_POST['clave_ingresada']))
    {
        $rut = $_POST['nombre_ingresado'];
        $user_password = $_POST['password'];
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['nombre_ingresado'] = $_POST['nombre_ingresado'];
        $_SESSION['clave_ingresada'] = $_POST['clave_ingresada'];

        $query = "SELECT * FROM usuarios WHERE nombre_usuario = '$_POST['nombre_ingresado']' AND clave = '$_POST['clave_ingresada']';"; 
        $result = $db1 -> prepare($query); # Enviamos la consulta a la BDD impar
        $result -> execute();
        $usuario = $result -> fetchAll();

        if !empty($usuario){
            if $usuario[3] = 'artista'{
                header("pagina_artista.php");
            }
            elseif $usuario[3] = 'productora'{
                header("pagina_productora.php");
            }
        }

        #$msg = "Sesión iniciada correctamente";
        #header("Location: ../index.php?msg=$msg");
    }
?>