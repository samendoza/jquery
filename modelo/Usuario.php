<?php
    class Usuario{
        private $usuario;
        private $pass;
        private $img;

        function __construct($usuario, $pass){
            $this->usuario = $usuario;
            $this->pass = $pass;
        }

        public function iniciarSesion(){
            $db = new DataBase();
            $db->conectar();
            
            $query = "Select * from registroUsuario where usuario = '".$this->usuario."' and pass='".$this->pass."'";
            //echo $query;
            $result = $db->consulta($query);

            //Si hay un registro, el usuario y la contraseña existen
            if($result->num_rows > 0) {
                //redireccion a nueva pagina con inicio de sesion exitoso
                while($row = mysqli_fetch_assoc($result)){
                     $this->img = $row['fotoUsuario'];
                 }
                 //echo "img: ".$this->img;
                $db->desconectar();
                return true;
            }
    
            //echo "no existe el usuario";
            $db->desconectar();
            return false;
            
        }

        public function getUsuario(){
            return $this->usuario;
        }

        public function registrar(){
            $db = new DataBase();
            $db->conectar();
            
            $query = "insert into registrousuario (usuario, pass, fotoUsuario) values('".$this->usuario."','".$this->pass."','".$this->img."')";
            //echo $query;
            $result = $db->consulta($query);
            

            if($result) {
                $db->desconectar();
                return true;
            }

            $db->desconectar();
            return false;
        }

        public function estaRegistrado(){
            $db = new DataBase();
            $db->conectar();
            
            $query = "Select * from registroUsuario where usuario = '".$this->usuario."'";
            //echo $query;
            $result = $db->consulta($query);

            //Si hay un registro, el usuario y la contraseña existen
            if($result->num_rows > 0) {
                 
                //redireccion a nueva pagina con inicio de sesion exitoso
                $db->desconectar();
                return true;
            }
    
            //echo "no existe el usuario";
            $db->desconectar();
            return false;
        }

        public function setImg($img){
            $this->img = $img;
        }

        public function getImg(){
            return $this->img;
        }
    }
?>