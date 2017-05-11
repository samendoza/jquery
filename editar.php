<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){ //hasta que la pagina este completamente cargada

                $("#fmregistro").submit(function(event){ //al dar clic en enviar:

                    event.preventDefault(); //previene que el formulario se procese como lo hace normalmente 
                    
                    var formData = new FormData($(".fmregistro")[0]);
                    //formData.append("peticion","agregar");

                    var $form = $( this ), // crea una variable form que apunta al formulario
                    url = $form.attr( "action" );
                    
                     $.ajax({
                        url: url,  
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
                        }
                    });
                });

                $("#usuarioR").keyup(function(){
                    $("#avisoUsuario").show();
                   // alert($(this).val());
                    var usuario = $(":input[name='usuarioR']").val();
                    var posting = $.post( "controladores/reg.php", {usuario: usuario});
                    posting.done(function( data ) {
                        if(data == "1"){    
                            $("#avisoUsuario").show().css("color","red").text("El nombre de usuario está ocupado");
                            
                        }
                        else if(data == "2"){
                             $("#avisoUsuario").show().css("color","green").text("El nombre de usuario está disponible");
                        }
                    });
                });

            });


        </script>
    </head>
    <body>
        <form method="POST" action="controladores/CtrlPerfil.php" id="fmregistro" class="fmregistro" enctype="multipart/form-data">
            <span> Contraseña actual </span><br>
			<input type="password" name="pass" placeholder="Contraseña actual" id="usuarioR" required> </input>
            
            <br>

            <span> Nueva contraseña </span><br>
			<input type="password" name="passN" placeholder="Nueva contraseña" required> </input> <br>

            <span> Repetir nuevacontraseña </span><br>
			<input type="password" name="passN2" placeholder="Repetir nueva contraseña" required> </input> 

            <span id="avisoPass" style="display:none"> </span><br>
             Cambiar imagen: <input type="file" name="foto" id="foto"></input><br>
            <br>

			<input type="submit" value="registrarme"> </input>
		</form>
    </body>
</html>