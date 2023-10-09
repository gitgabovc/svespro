$(document).ready(function() {

    const btnCambiarImg = document.querySelector('#btnCambiarImg');
    const btnCancelarImg = document.querySelector('#btnCancelarImg');
    const verificacion = document.querySelector('#verificacion');
    
    btnCambiarImg && btnCambiarImg.addEventListener('click', cambiarImagen);
    btnCancelarImg && btnCancelarImg.addEventListener('click', cancelarImg);

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

    $("#FormDatos").submit(function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe de forma tradicional
         var formData = new FormData($(this)[0]);
 
         $.ajax({
             type: "POST",
             url: "producto/insert",
             data: formData,
             contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
             success: function(response) {
                 // Manejar la respuesta del servidor si es necesario
                 if (response == "si") {
                    window.location.href = "http://localhost:8080/svespro/producto";
                 }
             },
             error: function(xhr, status, error) {
                 // Manejar errores si es necesario
             }
         });
     });
 });