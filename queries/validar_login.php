<?php
	session_start();
?>

<?php
    require("../config/conexion.php");
    $msg = '';
    if (isset($_POST['login']) && !empty($_POST['nombre_ingresado']) && !empty($_POST['clave_ingresada']))
    {
        $nombre_ingresado = $_POST['nombre_ingresado'];
        $clave_ingresada = $_POST['clave_ingresada'];
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['nombre_ingresado'] = $_POST['nombre_ingresado'];
        $_SESSION['clave_ingresada'] = $_POST['clave_ingresada'];

        $query = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_ingresado' AND clave = '$clave_ingresada';"; # Buscamos el nombre y clave ingresados 
        # echo " $nombre_ingresado, $clave_ingresada";
        $result = $db1 -> prepare($query); # Enviamos la consulta a la BDD impar
        $result -> execute();
        $usuarios = $result -> fetchAll();

        foreach($usuarios as $usuario){
            if (!empty($usuario)){
                if ($usuario[3] == 'artista'){
                    header("Location:./pagina_artistas.php"); 
                    exit;
                }
                elseif ($usuario[3] == 'productora'){
                    header("Location:./pagina_productoras.php"); 
                    exit;
                }
            
            }
        }



        #$msg = "Sesión iniciada correctamente";
        #header("Location: ../index.php?msg=$msg");
    }
?>