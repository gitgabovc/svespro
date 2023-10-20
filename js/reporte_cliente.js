$(document).ready(function()
{
//alert('gsdgdfgdfg');


const selectCliente = document.querySelector('#txtCliente');
const fechaInicio = document.querySelector('#fechaInicio');
const fechaFinal = document.querySelector('#fechaFinal');
const btnHabilitarFechas = document.querySelector('#btnHabilitarFechas');
const fechaIncorrecta = document.querySelector('#fechaIncorrecta');
const fechaVacia = document.querySelector('#fechaVacia');
const sinCliente = document.querySelector('#sinCliente');

$('#btnHabilitarFechas').click(function(e){
     e.preventDefault();
     

     if (btnHabilitarFechas.textContent == "Habilitar Fechas") {
          
          fechaInicio.disabled = false;
          fechaFinal.disabled = false;
          btnHabilitarFechas.textContent = "Desahabilitar Fechas";
          btnHabilitarFechas.classList.remove("btn-primary");
          btnHabilitarFechas.classList.add("btn-info");
     }else{
          fechaInicio.disabled = true;
          fechaFinal.disabled = true;
          btnHabilitarFechas.textContent = "Habilitar Fechas";
          btnHabilitarFechas.classList.remove("btn-info");
          btnHabilitarFechas.classList.add("btn-primary");

     }

     
    

});


$('#btnGuardar').click(function(){

     // Control que seleccione un cliente
     if([selectCliente.value].includes("")){
          sinCliente.style.display = "block";
               setTimeout(() => {
                    sinCliente.style.display = "none";
                    
               }, 4000);
               return;
     }

     // Envio sin fechas
     if (btnHabilitarFechas.textContent == "Habilitar Fechas") {
          


          if (selectCliente.value !=0) {
               
               window.open("clienteSinConFecha/"+selectCliente.value);
          }else{
               window.open("clienteTodosSinConFecha");

          }

          // $.ajax({
          //      type: "POST",
          //      url: "reporte/clienteSinFecha",
          //      data: obj,
          //      success: function(r){
          //           console.log(r);
          //      }
          // });
          
     }else{

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
          

          if (selectCliente.value != 0) {
               
               window.open("clienteSinConFecha/"+selectCliente.value+"/"+fechaInicio.value+"/"+fechaFinal.value);
          } else {
               window.open("clienteTodosSinConFecha/"+fechaInicio.value+"/"+fechaFinal.value);
               
          }


          return;


          $.ajax({
               type: "POST",
               url: "reporte/clienteConFecha",
               data: obj,
               success: function(r){
                    console.log(r);
               }
          });

     }


     
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