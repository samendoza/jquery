<html>
    <head>
        <meta charset="UTF-8">
        <title> Página de prueba </title>
        <meta name="description" content="Página de prueba para uso de jquery y php">
        <meta name="keywords" content="HTML5, PHP, Jquery">
        <!--<Link rel="stylesheet href="default.css"-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="js/contacto.js"></script>
        <script>
            $(document).ready(function(){
                $("#cerrarSesion").click(function(){
                    alert("Salir sesion");
                    $(location).attr('href',"controladores/logout.php");
                });

                $("#editarPerfil").click(function(){
                      $(location).attr('href',"editar.php");
                });

                $("#mostrarContent").click(function(){
                    $("#content").empty();
                    $("#content").load("cont.html");
                });

                $("#agregarCont").click(function(){
                    //$("#content").empty();
                    $("#content").load("addContac.html");
                });

                /*************************************************************************************/


                $(document).on("keyup",".busqueda", busqueda);
                $(document).on("click", ".rbCategoria", busqueda);
                //$(document).on("click", "#agregar", busqueda);

                //$("#busqueda").keyup(busqueda);
                //$(".rbCategoria").click(busqueda);
                //$("#agregar").click(function(){
                    //showMessage("");
                    //$("#fmAgregar").show();
                //});
                //$(".fmAddCont").submit(agregar);
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
            <header>
                <h1> Bienvenido(a) <?php echo $_SESSION['usuario']; ?> </h1> 
                <?php
                    echo "<img src='".$_SESSION['foto']."' style='height: 100px; width:100px;'></img>";
                ?>  
                <h2> Agenda electrónica </h2> 
            </header>
            <nav>
                <ul>
                    <li> Contactos <ul>
                        <li id="mostrarContent"> Buscar contactos </li>
                        <li id="agregarCont"> Agregar contactos </li>
                    </ul></li>
                    <li id="editarPerfil"> Editar perfil </li>
                    <li id="cerrarSesion"> Cerrar sesión </li>
                    <li> Otras cosas </li>
                </ul>
            </nav>
            <main>
                <section>
                    <p> Contenido </p>
                    <div id="content">

                    </div>
                </section>
                <aside>
                    Alguna información extra
                </aside>
            </main>
            <footer>
                Elaborado por: Saul Mendoza
            </footer>
        </div>
    </body>
</html>