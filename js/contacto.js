/*************************************************************************************************************************
*Funcion busqueda():realiza una peticion ajax con el metodo get para mostrar los contactos que cumplan con los criterios 
*                   especificados en la busqueda
/*************************************************************************************************************************/
function busqueda(){
    var busqueda = $(":input[name='busqueda']").val();
    var categoria = $("input[name='categoria']:checked").val();
    var posting = $.get( "controladores/ctrlContacto.php", {busqueda:busqueda, categoria:categoria, peticion: "buscar"});
    posting.done(function( data ) {
        $("#respuesta").show().html(data);
    });
}

/*************************************************************************************************************************
*Funcion busqueda():realiza una peticion ajax con el metodo post para eliminar el contacto al que se le hizo clic
*Parametros: btn-> es el boton corresponiente al contacto que se quiere eliminar
/*************************************************************************************************************************/
function eliminar(btn){
    var valor = btn.value;
    var mensaje = confirm("¿Está seguro que desea eliminar este contacto?");
    
    if (mensaje) {
        var posting = $.post( "controladores/ctrlContacto.php", {valor: valor, peticion: "eliminar"});
        posting.done(function( data ) {
            alert(data);
            busqueda();
        });
    }            
}

/*************************************************************************************************************************
*Funcion agragar():realiza una peticion ajax con el metodo post agregar un nuevo contacto, junto con una 
*                  foto para identificarlo
*Parametros: event->objeto que configura el comportamiento del submit
/*************************************************************************************************************************/
function agregar(event){
    event.preventDefault();
    
    var formData = new FormData($(".fmAddCont")[0]);
    formData.append("peticion","agregar");

    $.ajax({
        url: 'controladores/ctrlContacto.php',  
        type: 'POST',
        //datos del formulario
        data: formData,
        //necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
        //mientras enviamos el archivo
        beforeSend: function(){
            message = $("<span class='before'>Subiendo la imagen, por favor espere...</span>");
            showMessage(message);
        },
        //una vez finalizado correctamente
        success: function(data){
            alert(data);
            busqueda();

            //limpiar el formulario
            $( ":input[name='nombre']" ).val("");
            $( ":input[name='tel']" ).val("");
            $( ":input[name='cel']" ).val("");
            $( ":input[name='dir']" ).val("");
            $( ":input[name='email']" ).val("");
        
            $("#fmAgregar").hide();
            message = $("<span class='success'>La imagen ha subido correctamente.</span>");
            showMessage(message);
        },
        //si ha ocurrido un error
        error: function(){
            message = $("<span class='error'>Ha ocurrido un error.</span>");
            showMessage(message);
        }
    });
}

function showMessage(message){
    $(".messages").html("").show();
    $(".messages").html(message);
}