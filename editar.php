<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){ //hasta que la pagina este completamente cargada

                $("#fmEditar").submit(function(event){ //al dar clic en enviar:

                    event.preventDefault(); //previene que el formulario se procese como lo hace normalmente 
            
                    var formData = new FormData($(".fmEditar")[0]);
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
                            if(data == "1") 
                                alert("Contraseña cambiada con éxito, vuelva a iniciar la sesion");
                               // $(location).attr('href',"controladores/logout.php");
                            
                        },
                        //si ha ocurrido un error
                        error: function(){
                            message = $("<span class='error'>Ha ocurrido un error.</span>");

                        }
                    });
                });
            });


        </script>
    </head>
    <body>
        <h1> Actualizar datos de perfil </h1>
        <form method="POST" action="controladores/CtrlPerfil.php" id="fmEditar" class="fmEditar" enctype="multipart/form-data">
            <span> Contraseña actual </span><br>
			<input type="password" name="pass" placeholder="Contraseña actual" id="pass" required> </input>
            <br>

            <span> Contraseña nueva </span><br>
			<input type="password" name="passN" placeholder="Contraseña nueva" required> </input> <br>

            <span> Repetir contraseña nueva</span><br>
			<input type="password" name="pass2N" placeholder="Repetir contraseña nueva" required> </input><br> 
            
            Agregar una imagen: <input type="file" name="foto" id="foto"></input><br>
            <br>

			<input type="submit" value="Guardar cambios"> </input>
		</form>
    </body>
</html>