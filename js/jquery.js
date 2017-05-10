/**************************************************************************************
* Función que recupera informacion de un formulario y lo envia al servidor mediante ajax
* y el metodo post
/**************************************************************************************/
$(document).ready(function(){ //hasta que la pagina este completamente cargada
    
    $("#avisoSes").hide();
    $("#fmInicioSesion").submit(function(event){ //al dar clic en enviar:

        $("#avisoSes").hide();
        event.preventDefault(); //previene que el formulario se procese como lo hace normalmente 
        
        var $form = $( this ), // crea una variable form que apunta al formulario
        
        //se obtienen los datos del formulario, se pueden obtener de dos formas:
        
        //1) mediante el selector :input[name='algo'] 
        usuario = $(":input[name='usuario']").val(), 
        
        //2) con una variable que haga referencia al formulario, y buscar los input
        pass = $form.find( "input[name='pass']" ).val(),
        
        //$variable.attr devuelve el valor de un atributo en especifico
        url = $form.attr( "action" );
        
        // Se envia la peticion a la url junto con un objeto data, que puede ser un array {llave:valor}
        var posting = $.post( url, {usuario: usuario, pass: pass});
        
        //Se puede tratar la información con la que responde el servidor
        //En este caso se envia la informacion de respuesta a un div
        posting.done(function( data ) {
            //alert(data);
            //Caso 1: Sesion iniciada correctamente, se redirige al contenido
            //Caso 2: Error en usuario y/o contraseña
            //Caso 3: Algun campo vacio
            if(data=="1"){
                //alert("Caso 1");
                var url = "contenido.php"; 
                $(location).attr('href',url);
            }
            else if(data == "2"){
                $("#avisoSes").show();
                $("#avisoSes").text("Usuario y/o contraseña incorrecto").css("color","red");
            }
            else{
                $("#avisoSes").show();
                $("#avisoSes").text("Algun campo vacio");
            }
            
        });
        /****************************************************************************/
        
    });
});