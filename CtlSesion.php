<?php
    require 'Database.php';
    require 'Usuario.php';

    //Caso 1: Sesion iniciada correctamente, se redirige al contenido
    //Caso 2: Error en usuario y/o contraseña
    //Caso 3: Algun campo vacio

    if($_POST['usuario']&& $_POST['pass']){
        //echo "No estan vacios";
        //Obtener datos del formulario
        $user = $_POST['usuario'];
        $pass = $_POST['pass'];

        //verificacion de usuario y contraseña
        $usuario = new Usuario($user, $pass);
        if($usuario->iniciarSesion()){
            session_start();
            $_SESSION['usuario'] = $usuario->getUsuario();
            $_SESSION['logged_in'] = true;
            echo "1";
        }
        else
            echo "2";
        
    }
    else
        echo "3";
?>