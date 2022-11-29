<?php
	session_start();
?>

<?php
    require("../config/conexion.php");
    $msg = '';
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password']))
    {
        $rut = $_POST['username'];
        $user_password = $_POST['password'];
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];

        $query = "SELECT * FROM usuarios WHERE nombre_usuario = $_POST['username'] AND clave = $_POST['password'];"; 
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