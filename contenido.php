<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $("#cerrarSesion").click(function(){
                    alert("Salir sesion");
                    $(location).attr('href',"controladores/logout.php");
                });

                $("#editarPerfil").click(function(){
                     $(location).attr('href',"editar.php");
                });
            });
        </script>
    </head>
    <body>
        <?php
            session_start(); 
            if(!isset($_SESSION['logged_in']))
                header("Location: index.php");  
        ?>

        <h1> Bienvenido(a) <?php echo $_SESSION['usuario']; ?> </h1> 
        <?php
             echo "<img src='".$_SESSION['foto']."' style='heigth: 100px; width:100px;'></img>";
        ?>  
        <button id="editarPerfil"> Editar perfil </button>

        <p> Contenido </p>

        <ul>
            <li> <a href="contactos.php"> Contactos </a> </li>
            <li> Otras cosas </li>
        </ul>
        <button  id="cerrarSesion"> Cerrar sesión </button>
    </body>
</html>