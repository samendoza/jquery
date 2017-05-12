<html>
	<head>
		<meta charset="UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){ //hasta que la pagina este completamente cargada

                $("#fmregistro").submit(function(event){ //al dar clic en enviar:

                    event.preventDefault(); //previene que el formulario se procese como lo hace normalmente 
                    
                    var formData = new FormData($(".fmregistro")[0]);
                    formData.append("peticion","agregar");

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
                            if(data == "1"){
                                alert("Usuario registrado con exito");
                                var url = "index.php"; 
                                $(location).attr('href',url);
                            }
                            else if(data == "2")
                                alert("No podemos registrar su usuario");
                            else
                                alert("Las contraseñas no coinciden");
                                message = $("<span class='success'>La imagen ha subido correctamente.</span>");
                        },
                        //si ha ocurrido un error
                        error: function(){
                            message = $("<span class='error'>Ha ocurrido un error.</span>");
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
		<h1> Registro </h1>
		<form method="POST" action="controladores/CtrlCuenta.php" id="fmregistro" class="fmregistro" enctype="multipart/form-data">
            <span> Nombre de usuario </span><br>
			<input type="text" name="usuarioR" placeholder="Usuario" id="usuarioR" required> </input>
            <span id="avisoUsuario" style="display:none"> </span>
            <br>

            <span> Contraseña </span><br>
			<input type="password" name="passR" placeholder="Contraseña" required> </input> <br>

            <span> Repetir contraseña </span><br>
			<input type="password" name="pass2R" placeholder="Repetir contraseña" required> </input> 
            <span id="avisoPass" style="display:none"> </span><br>
             Agregar una imagen: <input type="file" name="foto" id="foto"></input><br>
            <br>

			<input type="submit" value="Guardar cambios"> </input>
		</form>
		
	</body>
</html>