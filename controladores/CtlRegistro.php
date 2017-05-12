<?php
    require '../modelo/Database.php';
    require '../modelo/Usuario.php';

    
    if($_POST['usuarioR']&& $_POST['passR'] && $_POST['pass2R']){
        $user = $_POST['usuarioR'];
        $pass = $_POST['passR'];
        $pass2 = $_POST['pass2R'];

        if($pass == $pass2){
            $usuario = new Usuario($user, $pass);
            $nombreArch = $_POST['usuarioR'].".".explode(".",$_FILES['foto']['name'])[1];
            //echo $nombreArch;
            $usuario->setImg("img/fotosUsuario/".$nombreArch);

            //Caso 1: El usuario se registro con exito
            //Caso 2: Hay un problema interno al hacer el registro
            //Caso 3: Las contraseñas no coinciden

            if($usuario->registrar()){
                subirFoto($nombreArch);
                echo "1";
               
            }
            else
                echo "2";
        }

        else
            echo "3";
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