<?php
    require '../modelo/Database.php';
    require '../modelo/Usuario.php';

    session_start();
    //Caso 1: la contraseña se actualizo exitosamente

    if($_POST['pass']&& $_POST['passN'] && $_POST['pass2N']){
        $passN = $_POST['passN'];
        $pass2N = $_POST['pass2N'];
        $usuario = new Usuario($_SESSION['usuario'], $_POST['pass']);
        if($_FILES['foto']['name']=='')
            echo "Foto vacia";
        else {
            $nombreArch = $_SESSION['usuario'].".".explode(".",$_FILES['foto']['name'])[1];
            echo "Cambiar foto";
            subirFoto($nombreArch);
        }
       
        if($usuario->iniciarSesion()){
            //echo "Datos correctos";
            if($passN==$pass2N){
                echo "Las contraseñas coinciden";
                if($usuario->actualizarPass($passN)){
                    echo "1";
                }
                else{
                    echo "Error al actualizar las contraseñas";
                }
            }
            else
                echo "Las contraseñas no coinciden";
            
           
        }
        else
            echo "Datos erroneos";
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
            // echo $file;//devolvemos el nombre del archivo para pintar la imagen
        }
    }
    
?>