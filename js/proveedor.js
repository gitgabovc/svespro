$(document).ready(function(){

$('#btnGuardar').click(function(){

 	var  formData=$('#FormDatos').serialize();
     //alert(formData);
     //return false;

     $.ajax({
          type: "POST",
          url: "proveedor/insert",
          data: formData,
          success: function(r){
               console.log(r);
          }
     });

          //return false; // elimina que la pagina se recargue
	});


});