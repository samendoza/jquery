<?php
    class Contacto{

        private $idContacto;
        private $nombre;
        private $tel;
        private $cel;
        private $direccion;
        private $email;

        private $categoria;

        function __construct($arreglo){
            if($arreglo['peticion'] == "agregar"){
                $this->nombre =  $arreglo['nombre'];
                $this->tel = $arreglo['tel'];
                $this->cel =  $arreglo['cel'];
                $this->direccion =  $arreglo['dir'];
                $this->email =  $arreglo['email'];   
            }
            else if($arreglo['peticion'] == "buscar"){
                $this->categoria = $arreglo['categoria'];
                
                switch($arreglo['categoria']){
                    case "nombre":
                        $this->nombre =  $arreglo['busqueda'];
                        break;
                    case "email":
                        $this->email =  $arreglo['busqueda'];
                        break;
                    case "cel":
                        $this->cel =  $arreglo['busqueda'];
                        break;
                }
            }  
            else if($arreglo['peticion'] == "eliminar"){
                $this->idContacto = $arreglo['valor'];
            }
        }

        public function busqueda($usuario){
            $db = new DataBase();
            $db->conectar();
            
            switch($this->categoria){
                    case "nombre":
                        $query = "Select * from contacto c, registroUsuario r where c.idUsuario = r.usuario ".
                                 "and  idUsuario = '".$usuario."' and nombre like '%".$this->nombre."%'";
                        break;
                    case "email":
                        $query = "Select * from contacto c, registroUsuario r where c.idUsuario = r.usuario ".
                                 "and  idUsuario = '".$usuario."' and email like '%".$this->email."%'";
                        break;
                    case "cel":
                        $query = "Select * from contacto c, registroUsuario r where c.idUsuario = r.usuario ".
                                 "and  idUsuario = '".$usuario."' and cel like '%".$this->cel."%'";
                        break;
                }
            //echo $query;
           
            $result = $db->consulta($query);
            $resp = "<table><tr><td>Nombre</td><td>Correo</td><td>Tel fijo</td><td>Celular</td><td>Dirección</td><td>Eliminar</td></tr>";

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $resp .= "<tr>";
                    $resp .= "<td>".$row['nombre']."</td>";
                    $resp .= "<td>".$row['email']."</td>";
                    $resp .= "<td>".$row['tel']."</td>";
                    $resp .= "<td>".$row['cel']."</td>";
                    $resp .= "<td>".$row['direccion']."</td>";
                    $resp .= "<td><button onclick='eliminar(this)' value=".$row['idContacto']." ><img  style = ' height: 20px; width: 20px; ' src='img/eliminar.png'></img></button></td>";
                    $resp .= "</tr>";
                }
                 $resp .= "</table>";
            }
            else
                $resp = "No hay resultados disponibles para esta busqueda";

            $db->desconectar();
            return $resp;
        }

        public function eliminar(){
            $db = new DataBase();
            $db->conectar();
            $query = "delete from contacto where idContacto = ".$this->idContacto;
            //echo $query;
            if ($db->consulta($query)) {
                $db->desconectar();
                return true;
            } 
            else {
                $db->desconectar();
                return false;
            }
        }

        public function agregar($idUsuario){
            $db = new DataBase();
            $db->conectar();
            $query = "insert into contacto (idUsuario, nombre, tel, cel, email, direccion) values ('".$idUsuario."','".$this->nombre."','".$this->tel."','".$this->cel."','".$this->email."','".$this->direccion."')";
            
            //echo $query;
            if ($db->consulta($query)) {
                $db->desconectar();
                return true;
            } 
            else {
                $db->desconectar();
                return false;
            }

        }


        

    }
?>