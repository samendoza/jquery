<?php

    require 'Database.php';
    require 'Usuario.php';

    if($_POST['usuario']){
        $user = $_POST['usuario'];
        $usuario = new Usuario($user, "");

        //Caso 1: El usuario ya existe
        //Caso 2: El nombre de usuario esta disponible
        if($usuario->estaRegistrado()){
            echo "1";
        }
        else{
            echo "2";
        }

    }
?>