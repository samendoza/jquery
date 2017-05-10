<?php
    include 'DataBase.php';
    include 'Contacto.php';

    if($_POST['peticion']){
        
        session_start();
        
        $contacto = new Contacto($_POST);
        if($contacto->agregar($_SESSION['usuario'])){
            echo "Contacto Agregado con exito";
        }
        else{
            echo "Error al agregar contacto";
        }        
    }
?>