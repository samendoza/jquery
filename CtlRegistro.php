<?php
    require 'Database.php';
    require 'Usuario.php';

    
    if($_POST['usuario']&& $_POST['pass'] && $_POST['pass2']){
        $user = $_POST['usuario'];
        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];

        if($pass == $pass2){
            $usuario = new Usuario($user, $pass);

            //Caso 1: El usuario se registro con exito
            //Caso 2: Hay un problema interno al hacer el registro
            //Caso 3: Las contraseñas no coinciden

            if($usuario->registrar())
                echo "1";
            else
                echo "2";
        }

        else
            echo "3";
    }

?>