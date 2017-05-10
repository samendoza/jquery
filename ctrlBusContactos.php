<?php
    require 'DataBase.php';
    require 'Contacto.php';

    session_start();
    
    if($_GET['busqueda']&&$_GET['categoria']&&$_GET['peticion']){
        //echo "Si estan establecidas";
        $contacto = new Contacto($_GET);
        $resp = $contacto->busqueda($_SESSION['usuario']);
        echo $resp;
    }
?>