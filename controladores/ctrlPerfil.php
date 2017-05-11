<?php
    require '../modelo/Database.php';
    require '../modelo/Usuario.php';

    session_start();
    
    if($_POST['pass']&& $_POST['passN'] && $_POST['passN2']){
        echo "llegue a erfil";
        $usuario = new Usuario($_SESSION['usuario'], $_POST['pass']);
        if($usuario->iniciarSesion()){
            echo "Datos validos";
        }
        else
            echo "Datos no validos";
    }

    function eliminarFoto($contacto){
        $ruta = $contacto->getDirImagen();
        unlink("../".$ruta);
           
    }

    function subirFoto(){
        if(!is_dir("../img/fotosUsuario")) 
            mkdir("../img/fotosUsuario", 0777);
        
        //comprobamos si el archivo ha subido
        if ($_FILES['foto']['name'] && move_uploaded_file($_FILES['foto']['tmp_name'],"../img/fotosUsuario/".$_POST['usuarioR']."_".$_FILES['foto']['name'])){
            sleep(3);//retrasamos la petición 3 segundos
            // echo $file;//devolvemos el nombre del archivo para pintar la imagen
        }
    }
    
?>