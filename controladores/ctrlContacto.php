<?php
    require '../modelo/DataBase.php';
    require '../modelo/Contacto.php';

    session_start();
    
    //Verificar que sea peticion get 
    if(isset($_GET['peticion']))
    {
        //Verificar que los campos de busqueda y contacto no esten vacios 
        //Buscar contactos
        if($_GET['peticion']=='buscar'&&$_GET['busqueda']&&$_GET['categoria']){
            $contacto = new Contacto($_GET);

            //Se devuelve a los contactos que coincidan con la busqueda
            $resp = $contacto->busqueda($_SESSION['usuario']);
            echo $resp;
        }
    }

    else if(isset($_POST['peticion'])){

        //Agregar contactos
        if( $_POST['peticion']=='agregar'){
            $contacto = new Contacto($_POST);

            //Si se registro con exito, devuelve  un mensaje de confirmacion
            if($contacto->agregar($_SESSION['usuario'])){
                echo "Contacto Agregado con exito";
            }
            else{
                echo "Error al agregar contacto";
            } 
        }

        else if($_POST['peticion']){
            
            $contacto = new Contacto($_POST);

            //Si se elimino con exito, devuelve un mensaje de confirmacion
            if($contacto -> eliminar()){
                echo "Contacto eliminado con exito";
            }
            else{
                echo "Error al intentar eliminar el usuario";
            }
        }
    }
?>