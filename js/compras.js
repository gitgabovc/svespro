$(document).ready(function()
{
  alert('compras');
$('#btnGuardar').click(function(){


    modificarSubtotales();//mio implementado

    var  formData=$('#articuloDetalle').serialize();
     //alert(formData);
     //return false;
     $.ajax({
          type: "POST",
          url: "compras/insert",
          data: formData,
          success: function(r){
            alert('Se registró la compra con éxito');
            //window.location.href = "compras/detalleArticulos/0";
            window.open(
                'compras/recibopdf/0',
                '_blank' // <- Esto es lo que hace que se abra en una nueva ventana.
              );
            window.location.href = "compras";
      }
     });
          //return false; // elimina que la pagina se recargue
  });



});


