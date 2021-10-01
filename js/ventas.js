$(document).ready(function()
{
  //alert('testssssss');
$('#btnGuardar').click(function(){
  //alert("funcion guardar");
    var contstocin=0;
    var contnega=0;
    var cant=document.getElementsByName("cantidad[]");
    var prev=document.getElementsByName("precioVenta[]");
    var stoc=document.getElementsByName("stock[]");
    var idCliente=$('#cbxPersona').val();
    
    if (idCliente=="") {alert('Seleccione Cliente...');}
    // busca stock insuficiente
    for (var i = 0; i < cant.length; i++) {
        var c=parseInt(cant[i].value);
        var s=parseInt(stoc[i].value);
        if (s<c) {
          contstocin++;
        }
    }
    // cuenta las cantidades negativas
    for (var i = 0; i < cant.length; i++) {
      var valor=cant[i].value;
        if (valor<0) {
          contnega++;
        }
    }

    modificarSubtotales();//mio implementado

    if (contstocin==0 && contnega==0) {
          var  formData=$('#articuloDetalle').serialize();
     //alert(formData);
     //return false;
     $.ajax({
          type: "POST",
          url: "ventas/insert",
          data: formData,
          success: function(r){
            //alert(r);
            alert('Se registró la venta con éxito');
            //window.location.href = "ventas/detalleArticulos/0";
            //window.location.href = "ventas/recibopdf/3";
            window.open(
                'ventas/recibopdf/0',
                '_blank' // <- Esto es lo que hace que se abra en una nueva ventana.
              );
            window.location.href = "ventas";
      }
     });
     
          //return false; // elimina que la pagina se recargue

    }

  });


 $("#myBtn").click(function(){
    //alert('holasssss');
    //$("#modalEjemplo").modal('show');

    $('#myModal55').modal('show');

    $.ajax({
      url: 'ventas/prueba',
      type: 'POST',
      data:{ci:'1'}
  }).done(function(data){
    
    //alert(data);
    var reg=eval(data);

    if (reg.length>0) 
    {
      
      for (var i = 0; i<reg.length; i++) {

      var  html = '<tr><td></td><td></td></tr>'; 

        $('#listaArticulosVendidos tbody').append(html);

      $('#myModal55').modal('show');
      
    }

    }else{
      alert("No existe Cliente con ci "+ci);
    }

    
    
   
  });
return false;



  });



    



});


