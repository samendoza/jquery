<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>

        function busqueda(){
            var busqueda = $(":input[name='busqueda']").val();
            var categoria = $("input[name='categoria']:checked").val();
            //alert(busqueda + " " + categoria);
            var posting = $.get( "controladores/ctrlContacto.php", {busqueda:busqueda, categoria:categoria, peticion: "buscar"});
            posting.done(function( data ) {
                $("#respuesta").show().html(data);
            });
        }

        function eliminar(btn){
            var valor = btn.value;
            //alert(btn.value);
            var mensaje = confirm("¿Está seguro que desea eliminar este contacto?");
           
            if (mensaje) {
                var posting = $.post( "controladores/ctrlContacto.php", {valor: valor, peticion: "eliminar"});
                posting.done(function( data ) {
                    alert(data);
                    busqueda();
                });
            }            
        }

        function agregar(event){
            event.preventDefault();
            alert("llegue");
            var formData = new FormData($(".fmAddCont")[0]);
            formData.append("peticion","agregar");
           


            /*var nombre = $(":input[name='nombre']").val();
            var email = $(":input[name='email']").val();
            var tel = $(":input[name='tel']").val();
            var cel = $(":input[name='cel']").val();
            var dir = $(":input[name='dir']").val();*/


            /*var posting = $.post( "controladores/ctrlContacto.php", {nombre:nombre, tel: tel, email: email, cel:cel, dir: dir, peticion: "agregar"});
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
            });*/

            $.ajax({
            url: 'controladores/ctrlContacto.php',  
            type: 'POST',
            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function(){
                message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
                //showMessage(message)        
            },
            //una vez finalizado correctamente
            success: function(data){
                alert(data);
                busqueda();
                $("#fmAgregar").hide();
                message = $("<span class='success'>La imagen ha subido correctamente.</span>");
                //showMessage(message);
               /* if(isImage(fileExtension))
                {
                    $(".showImage").html("<img src='files/"+data+"' />");
                }*/
            },
            //si ha ocurrido un error
            error: function(){
                message = $("<span class='error'>Ha ocurrido un error.</span>");
                
                //showMessage(message);
            }
        });
        }

        $(document).ready(function(){
             $("#busqueda").keyup(busqueda);
             $(".rbCategoria").click(busqueda);
             $("#agregar").click(function(){
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
            <form enctype="multipart/form-data" method="Post" action="controladores/ctrlContacto.php" class="fmAddCont">
                Nombre: <input type="text" name="nombre" required> </input><br>
                E-mail: <input type="text" name="email" required> </input><br>
                Tel. fijo: <input type="text" name="tel" required> </input><br>
                Celular: <input type="text" name="cel" required> </input><br>
                Dirección <input type="text" name="dir" required> </input><br>
                Agregar una imagen: <input type="file" name="foto" id="foto"></input><br>
               <!-- <input type="text" name="peticion" value="agregar" style="display: none"> </input> -->
                <input type="submit" value="Agregar contacto" required> </input>

            </form>
        </div>
    </body>
</html>