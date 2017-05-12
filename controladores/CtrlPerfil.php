<?php
    require '../modelo/Database.php';
    require '../modelo/Usuario.php';

    session_start();
    

    if($_POST['pass']&& $_POST['passN'] && $_POST['pass2N']){
        $passN = $_POST['passN'];
        $pass2N = $_POST['pass2N'];
        $usuario = new Usuario($_SESSION['usuario'], $_POST['pass']);
               
        if($usuario->iniciarSesion()){
            if($passN==$pass2N){
                if($usuario->actualizarPass($passN)){
                    if($_FILES['foto']['name']!=''){
                        $nombreArch = $_SESSION['usuario'].".".explode(".",$_FILES['foto']['name'])[1];
                        subirFoto($nombreArch);
                    }
                    echo "1"; //Caso 1)Cambio exitoso de contraseña y actualizacion de la informacion de perfil
                }
                else{
                    echo "2"; //Caso 2)No se pudo hacer el cambio de contraseña
                }
            }
            else
                echo "3";//Caso 3)Error, contraseña nueva no coincide
        }
        else
            echo "4";//Caso 4) Datos (contraseña) no coincide con la actual
    }

    function eliminarFoto($contacto){
        $ruta = $contacto->getDirImagen();
        unlink("../".$ruta);
           
    }

    function subirFoto($nombreArch){
        if(!is_dir("../img/fotosUsuario")) 
            mkdir("../img/fotosUsuario", 0777);
        
        //comprobamos si el archivo ha subido
        if ($_FILES['foto']['name'] && move_uploaded_file($_FILES['foto']['tmp_name'],"../img/fotosUsuario/".$nombreArch)){
            sleep(3);//retrasamos la petición 3 segundos
        }
    }
    
?>