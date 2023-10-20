$(document).ready(function()
{

const fechaInicio = document.querySelector('#fechaInicio');
const fechaFinal = document.querySelector('#fechaFinal');
const fechaIncorrecta = document.querySelector('#fechaIncorrecta');
const fechaVacia = document.querySelector('#fechaVacia');

$('#btnSinFechas').click(function(e){
     e.preventDefault();
     
     window.open("ventaSinFechas");


});


$('#btnFechas').click(function(){



     // Envio con fechas

     //control de que las fechas no esten vacias
     if ([fechaInicio.value, fechaFinal.value].includes("")) {
          fechaVacia.style.display = "block";
          setTimeout(() => {
               fechaVacia.style.display = "none";
               
          }, 4000);
          return;
     }

     const fi = new Date(fechaInicio.value);
     fi.setDate(fi.getDate() + 1);
     const ff = new Date(fechaFinal.value);
     ff.setDate(ff.getDate() + 1);


     // control de que la fecha incio no sea mayor a la fecha final
     if (fi>ff) {
          fechaIncorrecta.style.display = "block";
          setTimeout(() => {
               fechaIncorrecta.style.display = "none";
               
          }, 4000);
          return;
     }

     // si esta todo correcto crea el pdf con fecha
     window.open("ventaConFechas/"+fechaInicio.value+"/"+fechaFinal.value);
               



     


     
     // console.log(selectCliente.value);
     // return;
 	// var  formData=$('#FormDatos').serialize();
     // //alert(formData);
     // //return false;

     // $.ajax({
     //      type: "POST",
     //      url: "talla/insert",
     //      data: formData,
     //      success: function(r){
     //           console.log(r);



     //      }
     // });

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