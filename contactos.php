<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>

        function busqueda(){
            var busqueda = $(":input[name='busqueda']").val();
            var categoria = $("input[name='categoria']:checked").val();
            //alert(busqueda + " " + categoria);
            var posting = $.get( "ctrlBusContactos.php", {busqueda:busqueda, categoria:categoria, peticion: "buscar"});
            posting.done(function( data ) {
                $("#respuesta").show().html(data);
            });
        }

        function eliminar(btn){
            var valor = btn.value;
            //alert(btn.value);
            var mensaje = confirm("¿Está seguro que desea eliminar este contacto?");
           
            if (mensaje) {
                var posting = $.post( "ctrlAgContactos.php", {valor: valor, peticion: "eliminar"});
                posting.done(function( data ) {
                    alert(data);
                    busqueda();
                });
            }            
        }

        function agregar(event){
            event.preventDefault();
            var nombre = $(":input[name='nombre']").val();
            var email = $(":input[name='email']").val();
            var tel = $(":input[name='tel']").val();
            var cel = $(":input[name='cel']").val();
            var dir = $(":input[name='dir']").val();


            var posting = $.post( "ctrlAddCont.php", {nombre:nombre, tel: tel, email: email, cel:cel, dir: dir, peticion: "agregar"});
            posting.done(function( data ) {
                var $form = $("#fmAddCont");
                $form.find( "input[name='nombre']" ).val("");
                $form.find( "input[name='tel']" ).val("");
                $form.find( "input[name='cel']" ).val("");
                $form.find( "input[name='dir']" ).val("");
                $form.find( "input[name='email']" ).val("");
                alert(data);
                busqueda();
                $("#fmAgregar").hide();
            });
        }

        $(document).ready(function(){
             $("#busqueda").keyup(busqueda);
             $(".rbCategoria").click(busqueda);
             $("#agregar").click(function(){
                 $("#fmAgregar").show();
             });
             $("#fmAddCont").submit(agregar);
        });

        
        </script>
    </head>
    <body>
        <?php
            session_start(); 
            if(!isset($_SESSION['logged_in']))
                header("Location: index.php");  
        ?>

        <h1> Contactos </h1>

        Buscar contacto : <input type="text" name="busqueda" id="busqueda"> </input> <br> <br>
       
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
            <form method="Post" action="ctrlAddCont.php" id="fmAddCont">
                Nombre: <input type="text" name="nombre" required> </input><br>
                E-mail: <input type="text" name="email" required> </input><br>
                Tel. fijo: <input type="text" name="tel" required> </input><br>
                Celular: <input type="text" name="cel" required> </input><br>
                Dirección <input type="text" name="dir" required> </input><br>
                <input type="submit" value="Agregar contacto" required> </input>
            </form>
        </div>
    </body>
</html>