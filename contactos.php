<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="js/contacto.js"></script>
        <script>
            $(document).ready(function(){
                $("#busqueda").keyup(busqueda);
                $(".rbCategoria").click(busqueda);
                $("#agregar").click(function(){
                    showMessage("");
                    $("#fmAgregar").show();
                });
                $(".fmAddCont").submit(agregar);
            });
        </script>
    </head>
    <body>
        <?php
            session_start(); 
            if(!isset($_SESSION['logged_in']))
                header("Location: index.php");  
        ?>

        <div>
        <h1> Contactos </h1>

        Buscar contacto : <input type="text" name="busqueda" id="busqueda" class="busqueda"> </input> <br> <br>
       
        Buscar por: <br>
        <input type="radio" class="rbCategoria" name="categoria" value="nombre" checked> Nombre<br>
        <input type="radio" class="rbCategoria" name="categoria" value="email"> Correo electrónico <br>
        <input type="radio" class="rbCategoria" name="categoria" value="cel"> Celular
        <div id="respuesta" style="display: none"> </div>

        <br>
        <br>
        <button id="agregar" > Agregar contacto </button>
        <br>
        <br>
        <div id="fmAgregar" style="display: none;"> 
            <form enctype="multipart/form-data" method="Post" action="controladores/ctrlContacto.php" class="fmAddCont">
                Nombre: <input type="text" name="nombre" required> </input><br>
                E-mail: <input type="text" name="email" required> </input><br>
                Tel. fijo: <input type="text" name="tel" required> </input><br>
                Celular: <input type="text" name="cel" required> </input><br>
                Dirección <input type="text" name="dir" required> </input><br>
                Agregar una imagen: <input type="file" name="foto" id="foto"></input><br>
                <input type="submit" value="Agregar contacto" required> </input>

            </form>
            <div class="messages"> </div>
        </div>
    </body>
</html>