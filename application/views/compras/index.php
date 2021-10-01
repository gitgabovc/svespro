
<?php 
    if ($this->session->userdata('Compras')==1) {
?>



<!---script de confirmacion para delete-->
<script type="text/javascript">
  function preguntar(id){
    if (confirm('¿Esta realmente segur@ de Anular la compra..?')) 
    {
      window.location.href="compras/delete"+"/"+id;
    }
  }


var cont=0;
var detalles=0;
function agregarDetalle(idArticulo,nombre,precioVenta,precioCompra){

    var cantidad=1;
    //var descuento=0;

    if (idArtRepetido(idArticulo)) {
      alert("El articulo ya esta en la lista");
    }else{

      if (idArticulo!="") {
    var subtotal=cantidad*precioCompra;

    var fila='<tr class="filas" id="fila'+cont+'">'+
            '<td><button type="button" class="btn-floating btn-small red" onclick="eliminarDetalle('+cont+')">X</button></td>'+
            '<td><input type="hidden" name="idArticulo[]" value="'+idArticulo+'">' + nombre + '</td>'+
            '<td><input class="form-control" type="number" min="0" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
            '<td><input class="form-control" type="number" min="0" readonly onmousedown="return false;" step="0.01"  name="precioCompra[]" id="precioCompra[]" value="'+precioCompra+'"></td>'+
            '<td><span id="subtotal'+cont+'" name="subtotal">'+subtotal+'</span></td>'+
            '</tr>';
              cont++;
              detalles++;

    $('#detalles tbody').append(fila);
    modificarSubtotales();

}else{
alert("error al ingresar el detalle, revisar las datos del articulo ");
}

    }
    


}

function idArtRepetido(id){
    var rep=false;
  var idArt=document.getElementsByName("idArticulo[]");
  for (var i = 0; i < idArt.length; i++) {
    if (id==idArt[i].value) {
        rep=true;
    }
  }
  return rep;
}

function modificarSubtotales(){
    
    var cant=document.getElementsByName("cantidad[]");
    //var prev=document.getElementsByName("precioVenta[]");
    var prec=document.getElementsByName("precioCompra[]");//precio compra
    //var desc=document.getElementsByName("descuento[]");
    var sub=document.getElementsByName("subtotal");
    //var uti=document.getElementsByName("utilidad");


    for (var i = 0; i < cant.length; i++) {
        var inpV=cant[i];//cantidad
        //var inpP=prev[i];//precio venta
        var inpC=prec[i];//precio compra
        //var inpU=uti[i]; //utilidad
        var inpS=sub[i]; //sudtotal venta
        //var des=desc[i];

        //inpS.value=((inpV.value*inpP.value)-des.value);
        //inpU.value=inpV.value*(inpP.value-inpC.value);

        inpS.value=(inpV.value*inpC.value);
        
        //document.getElementsByName("utilidad")[i].innerHTML=inpU.value.toFixed(2);
        document.getElementsByName("subtotal")[i].innerHTML=inpS.value.toFixed(2);
    }

    calcularTotales();
}

function calcularTotales(){
    var sub = document.getElementsByName("subtotal");
    //var util = document.getElementsByName("utilidad");//mio
    var total=0.0;
    //var utilidad=0.0;

    for (var i = 0; i < sub.length; i++) {
        total += document.getElementsByName("subtotal")[i].value;
        //utilidad += document.getElementsByName("utilidad")[i].value;
    }
    $("#total").html("Bs/." + total.toFixed(2));
    $("#totalCompra").val(total);

    //$("#totalUtilidad").html("Bs/." + utilidad.toFixed(2));
    //$("#utilidad_venta").val(utilidad);

    //evaluar();
}



function eliminarDetalle(indice){
$("#fila"+indice).remove();
calcularTotales();
detalles=detalles-1;

}


function buscarCi(){
       var ci=$("#txtCiBuscar").val();

       //alert(ci);

      $.ajax({
      url: 'ventas/buscarCi',
      type: 'POST',
      data:{ci:ci}
  }).done(function(data){
    
    //alert(data);
    $('#txtNombre').val('');
    $('#txtCi').val('');
    var reg=eval(data);

    if (reg.length>0) 
    {
      for (var i = 0; i<reg.length; i++) {
      $('#txtNombre').val(reg[i]['nombre']+' '+reg[i]['primerApellido']+' '+reg[i]['segundoApellido']);
      $('#txtCi').val(reg[i]['numDocumento']);
      $('#txtIdCliente').val(reg[i]['idPersona']);
      
    }

    }else{
      alert("No existe Cliente con ci "+ci);
    }

    
    
   
  });
return false;
}







</script>








<!-- ============================================================== -->
<!-- Page wrapper scss in scafholding.scss -->
<!-- ============================================================== -->
<div class="page-wrapper">
          
    <!-- ============================================================== -->
    <!-- Container fluid scss in scafholding.scss -->
    <!-- ============================================================== -->


    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                       
                        <div class="row">

                            <div class="col s12">

                                <ul class="tabs">
                                  <li class="tab col s3"><a class="active" href="#test2"><b>Nueva Compra</b>
                                    <li class="tab col s3"><a  href="#lista"><b>Lista Compras</b></a></li>
                                    </a></li>
                                    
                                </ul>
                            </div>
                            <div id="lista" class="col s12">
                                
                    <!-- inicio tabla lista -->
                        <div class="divider"></div>

                                <table id="file_export" class="table table-striped table-bordered display">
                                                    <thead>
                                                        <tr>
                                                            <th>Nro</th>
                                                            <th>Fecha</th>
                                                            <th>Usuario</th>
                                                            <th>Total Compra</th>
                                                            <th>Estado</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        

                                                             <?php
                                              $indice=1;
                                              foreach($compras->result() as $row) 
                                              {
                                               ?>
                                               <tr>
                                                 <td><?php echo $indice; ?></td>
                                                 <td><?php echo $row->fecha; ?></td>
                                                 <td><?php echo $row->usuario; ?></td>
                                                 <td><?php echo $row->totalCompra; ?></td>
                                                 <td><?php 
                                                 $esta=$row->estado;
                                                 if ($esta==1) 
                                                  { echo "Activo";}
                                                else
                                                  { echo "Anulado";}
                                                   ?></td>
                                                 <td>
                                            <center>
                                                <a class="btn-floating btn-small red" onclick="preguntar(<?php echo $row->idCompra;?>)">
                                                <i class="large material-icons">close</i>
                                              </a>
                                              <a class="btn-floating btn-small cyan" href="<?php echo base_url('compras/recibopdf')."/".$row->idCompra; ?>">
                                                <i class="large material-icons">print</i>
                                              </a>
                                              
                                              <a class="btn-floating btn-small cyan" href="<?php echo base_url('compras/detalleArticulos')."/".$row->idCompra; ?>">
                                                <i class="large material-icons">visibility</i>
                                              </a>
                                                
                                            </center>
                                                 </td>
                                               </tr>
                                               <?php 
                                               $indice++;
                                              }
                                              ?>
                                                      
                                                        
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Nro</th>
                                                            <th>Fecha</th>
                                                            <th>Usuario</th>
                                                            <th>Total Compra</th>
                                                            <th>Estado</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </tfoot>
                                    </table>
                        <div class="divider"></div>
                    <!-- final tabla lista -->

                            </div>
                            <div id="test2" class="col s12">
                    <!-- inicio form agregar --> 
                                <form action="" name="articuloDetalle" id="articuloDetalle">
                                    <div class="form-body">
                                        <div class="divider"></div>
                                        <div class="card-content">
                                            
                                            <div class="row">

                                                <div class="col s12 m6 l4">

                                                    <ul class="tabs">
                                                        <li class="tab col s3"><a  class="btn waves-effect waves-light light blue" href="#listaEntel"><img src="<?php echo base_url();?>assets/images/entel-logo1.png" width="50"></a></li>
                                                        <li class="tab col s3"><a class="btn waves-effect waves-light light-green accent-3" href="#listaViva"><b>Viva</b></a></li>
                                                        <li class="tab col s3"><a class="btn waves-effect waves-light indigo darken-3" href="#listaTigo">Tigo</a></li>
                                                    </ul>
                                                </div>

                                                <h1>Compra de Artículos</h1>
 

                                            </div>
                                            <div class="row">
                                                <div class="col s12 m6 l4">
                                                    <!--inicio tabla articulos -->
                                                    <div id="listaEntel" class="col s12">
                                                    <table id="file_export1" class="table table-striped table-bordered display">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Precio Compra</th>
                                                            <th>Opcion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        

                                                             <?php
                                              
                                              foreach($artEntel->result() as $row) 
                                              { ?>
                                               <tr>
                                                 <td><?php echo "."; ?></td>
                                                 <td><?php echo $row->nombre; ?></td>
                                                 <td><?php echo $row->stock; ?></td>
                                                 <td><?php echo $row->precioCompra; ?></td>
                                                 <td>
                                            <center>
                                                <a class="btn-floating btn-small cyan" onclick="agregarDetalle(<?php echo $row->idArticulo; ?>,'<?php echo $row->nombre; ?>','<?php echo $row->precioVenta; ?>','<?php echo $row->precioCompra; ?>')">
                                                <i class="large material-icons">add_circle</i>
                                              </a>
                                            </center>
                                                 </td>
                                               </tr>
                                               <?php 
                                              }
                                              ?>
                                                      
                                                        
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Precio Compra</th>
                                                            <th>Opcion</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                </div>
                                                    <!--fin tabla articulos -->
                                                    <!--inicio tabla articulos Viva -->
                                                    <div id="listaViva" class="col s12">
                                                        <table id="file_export1" class="table table-striped table-bordered display">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Precio Compra</th>
                                                            <th>Opcion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                              
                                              foreach($artViva->result() as $row) 
                                              { ?>
                                               <tr>
                                                 <td><?php echo "."; ?></td>
                                                 <td><?php echo $row->nombre; ?></td>
                                                 <td><?php echo $row->stock; ?></td>
                                                 <td><?php echo $row->precioCompra; ?></td>
                                                 <td>
                                            <center>
                                                <a class="btn-floating btn-small cyan" onclick="agregarDetalle(<?php echo $row->idArticulo; ?>,'<?php echo $row->nombre; ?>','<?php echo $row->precioVenta; ?>','<?php echo $row->precioCompra; ?>')">
                                                <i class="large material-icons">add_circle</i>
                                              </a>
                                            </center>
                                                 </td>
                                               </tr>
                                               <?php 
                                              }
                                              ?>  
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Precio Compra</th>
                                                            <th>Opcion</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                    </div> 
                                                    <!--fin tabla articulos Viva -->
                                                    <!--inicio tabla articulos Tigo -->
                                                    <div id="listaTigo" class="col s12">
                                                        <table id="file_export1" class="table table-striped table-bordered display">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Precio Compra</th>
                                                            <th>Opcion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                              
                                              foreach($artTigo->result() as $row) 
                                              { ?>
                                               <tr>
                                                 <td><?php echo "."; ?></td>
                                                 <td><?php echo $row->nombre; ?></td>
                                                 <td><?php echo $row->stock; ?></td>
                                                 <td><?php echo $row->precioCompra; ?></td>
                                                 <td>
                                            <center>
                                                <a class="btn-floating btn-small cyan" onclick="agregarDetalle(<?php echo $row->idArticulo; ?>,'<?php echo $row->nombre; ?>','<?php echo $row->precioVenta; ?>','<?php echo $row->precioCompra; ?>')">
                                                <i class="large material-icons">add_circle</i>
                                              </a>
                                            </center>
                                                 </td>
                                               </tr>
                                               <?php 
                                              }
                                              ?>  
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Precio Compra</th>
                                                            <th>Opcion</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                    </div>
                                                    <!--fin tabla articulos Tigo -->
                                                </div>
                                                <div class="col s12 m6 l8">
                                                    <!-- inicio tabla ventas-->
                                                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover"  >
                                                       <thead style="background-color:#9BEFC3">
                                                        <th>Opciones</th>
                                                        <th>Articulo</th>
                                                        <th >Cantidad</th>
                                                        <th >Precio Compra</th>
                                                        <th>Subtotal</th>
                                                    
                                                       </thead>

                                                       <tfoot style="background-color:#9BEFC3">
                                                         <th></th>
                                                         <th></th>
                                                         
                                                         <th>TOTAL</th>
                                                         <th><h4 id="total">Bs/. 0.00</h4><input type="hidden" name="totalCompra" id="totalCompra"></th>
                                                         <th><button type="button" onclick="modificarSubtotales()" class="btn-floating btn-small red"><span class="material-icons">
                                                                        autorenew
                                                                        </span></i></button></th>
                                                       </tfoot>
                                                       <tbody>
                                                         
                                                       </tbody>
                                                     </table>
                                                    <!-- fin tabla ventas-->
                                                    <div class="divider"></div>
                                                        <div class="card-content">
                                                            <div class="form-action">
                                                                <button type="submit" onclick="return false" class="btn waves-effect waves-light cyan" id="btnGuardar"  name="btnGuardar"> <i class="fa fa-save"></i> Guardar
                                                                </button>
                                                                <button class="btn waves-effect waves-light grey darken-4" id="btnCancelar" name="btnCancelar" ><i class="fa fa-arrow-circle-left"></i> Cancelar
                                                                </button>
                                                            </div>
                                                        </div>

                                                </div>
                                            </div>
                                          
                                            
                                            
                                        </div>
                                       
                                        
                                    </div>
                                </form>
                    <!-- final form agregar -->
                            </div>

                            <div id="test3" class="col s12">...</div>
                        </div>
                                
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
            


<?php 
}
?>