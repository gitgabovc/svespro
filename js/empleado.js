$(document).ready(function()
{


     const btnCambiarImg = document.querySelector('#btnCambiarImg');
    const btnCancelarImg = document.querySelector('#btnCancelarImg');
    const verificacion = document.querySelector('#verificacion');
    
    btnCambiarImg && btnCambiarImg.addEventListener('click', cambiarImagen);
    btnCancelarImg && btnCancelarImg.addEventListener('click', cancelarImg);
     console.log("hola");
    function cambiarImagen(e){
        e.preventDefault();
        console.log("hola");
        const ocultar = document.querySelector('.ocultarAlCambiar');
        const mostrarAlCancelar = document.querySelector('.mostrarAlCancelar');
        ocultar.style.display = "none";

    // Crear un elemento input como nodo
        const inputSubida = document.createElement('input');
        inputSubida.type = "file";
        inputSubida.className = "form-control input-xs";
        inputSubida.name = "actualizacionImgFile";

        // Insertar el elemento input en el DOM
        mostrarAlCancelar.insertBefore(inputSubida, mostrarAlCancelar.firstChild);

        mostrarAlCancelar.style.display = "block";
        verificacion.value="con"

    }

    function cancelarImg (e){
        e.preventDefault();
        const ocultar = document.querySelector('.ocultarAlCambiar');
        ocultar.style.display = "block";
        const mostrarAlCancelar = document.querySelector('.mostrarAlCancelar');
        mostrarAlCancelar.style.display = "none";
        const inputSubida = mostrarAlCancelar.querySelector("input");
        inputSubida.remove();
        verificacion.value="sin";

    }

//alert('gsdgdfgdfg');

$('#btnGuardar').click(function(){

 	var  formData=$('#FormDatos').serialize();
     //alert(formData);
     //return false;

     $.ajax({
          type: "POST",
          url: "empleado/insert",
          data: formData,
          success: function(r){

          }
     });

          //return false; // elimina que la pagina se recargue
	});





     // function buscarID(IDjugador) {
     //      var idj = IDjugador;

     //      $.ajax({
     //          url: 'cliente/buscarIDiden',
     //          type: 'POST',
     //          data: {
     //           idj: idj
     //          }
     //      }).done(function(data) { 

     //          //alert(data);

     //          var reg = eval(data);

     //            if (reg.length > 0) {
     //                 var nombreCliente="";
     //                for (var i = 0; i < reg.length; i++) {
     //                     nombreCliente= reg[i]['nombre'];
     //                }
                    
     //               return  nombreCliente;

     //            } else {
     //                return "0";
     //            }

     //      });
     //      return false;  // comentando esta linea no registra
     //  }





});