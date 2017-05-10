<html>
	<head>
		<meta charset="UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){ //hasta que la pagina este completamente cargada

                $("#fmregistro").submit(function(event){ //al dar clic en enviar:

                    event.preventDefault(); //previene que el formulario se procese como lo hace normalmente 
                    
                    var $form = $( this ), // crea una variable form que apunta al formulario
                                      
                    usuario = $(":input[name='usuarioR']").val(), 
                    pass = $form.find( "input[name='passR']" ).val(),
                    pass2 = $form.find( "input[name='pass2R']" ).val(),
                    url = $form.attr( "action" );
                    // Se envia la peticion a la url junto con un objeto data, que puede ser un array {llave:valor}
                    var posting = $.post( url, {usuario: usuario, pass: pass, pass2: pass2});
                    posting.done(function( data ) {
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
                    });
                });

                $("#usuarioR").keyup(function(){
                    $("#avisoUsuario").show();
                   // alert($(this).val());
                    var usuario = $(":input[name='usuarioR']").val();
                    var posting = $.post( "reg.php", {usuario: usuario});
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
		<form method="POST" action="CtlRegistro.php" id="fmregistro">
            <span> Nombre de usuario </span><br>
			<input type="text" name="usuarioR" placeholder="Usuario" id="usuarioR" required> </input>
            <span id="avisoUsuario" style="display:none"> </span>
            <br>

            <span> Contraseña </span><br>
			<input type="password" name="passR" placeholder="Contraseña" required> </input> <br>

            <span> Repetir contraseña </span><br>
			<input type="password" name="pass2R" placeholder="Repetir contraseña" required> </input> 
            <span id="avisoPass" style="display:none"> </span>
            <br>

			<input type="submit" value="registrarme"> </input>
		</form>
		
	</body>
</html>