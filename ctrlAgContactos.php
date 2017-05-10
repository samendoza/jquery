<?php
    require 'DataBase.php';
    require 'Contacto.php';

    session_start();
    
    if($_POST['peticion']){
        //echo "Si estan establecidas";
        $contacto = new Contacto($_POST);
        //echo "Llegue";
        if($contacto -> eliminar()){
            echo "Contacto eliminado con exito";
        }
        else{
            echo "Error al intentar eliminar el usuario";
        }
    }
?>