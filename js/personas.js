$(document).ready(function()
{
//listarArticulos();

$('#btnGuardar').click(function(){
	
 	var  formData=$('#personaDatos').serialize();
     //alert(formData);
     //return false;
     
     $.ajax({
          type: "POST",
     	url: "personas/insert",
     	data: formData,
     	success: function(r){

     	}
     });
          //return false; // elimina que la pagina se recargue
	});


function Guardar(){
     e.preventDefault();//no se activara la accion predeterminada 
alert('holaaaa');
     $("#btnGuardar").prop("disabled",true);
     var formData=new FormData($("#articuloDatos")[0]);
     alert('holaaaa');
     $.ajax({
     	url: "../appplication/controllers/articulos/insert",
     	type: "POST",
     	data: formData,
     	contentType: false,
     	processData: false,

     	success: function(datos){
     		bootbox.alert(datos);
     		
     		
     	}
     });

     //limpiar();
}


     function listarArticulos(){
          $.ajax({
               type: 'ajax',
               url: 'articulos/listarArticulo',
               async: false,
               datatype: 'JSON',
               success: function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                         html+= '<tr>'+
                                    '<td>'+data[1]+'</td>'+
                                    '<td>'+data[2]+'</td>'+
                                    '<td>'+data[5]+'</td>'+
                                    '<td>'+data[i].precio_compra+'</td>'+
                                    '<td>'+data[i].precio_venta+'</td>'+
                                    '<td>'+data[i].descripcion+'</td>'+
                                    '<td>'+
                                         '<center>'+
                                             '<a href="">Editar</a>'+
                                             '<a href="">Eliminar</a>'+
                                         '</center>'+
                                    '</td>'+
                                  '</tr>';
                    }
                    $('#ArticulosLista').html(html);
               },
               error: function(){
                    alert('No existen datos para mostrar');
               }
          });
     }


    

});