
function editarPerfil(event){
      //$("#fmEditar").submit(function(event){ //al dar clic en enviar:

        event.preventDefault(); //previene que el formulario se procese como lo hace normalmente 

        var formData = new FormData($(".fmEditar")[0]);
        formData.append("peticion","modificar");

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
                    alert("Contraseña cambiada con éxito, vuelva a iniciar la sesion");
                    $(location).attr('href',"controladores/logout.php");
                }
                else if(data == "2"){
                    alert("Error al cambiar su contraseña");
                }
                else if(data == "3"){
                    alert("La contraseña nueva no coincide");
                }
                else{
                    alert("Los datos de sesion no son corectos");
                }
                    
                
            },
            //si ha ocurrido un error
            error: function(){
                message = $("<span class='error'>Ha ocurrido un error.</span>");

            }
        });
   // });
}