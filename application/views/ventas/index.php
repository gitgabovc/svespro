

<?php 
    if ($this->session->userdata('Ventas')==1) {
?>




<!---script de confirmacion para delete-->
<script type="text/javascript">
  function preguntar(id){
    if (confirm('¿Esta realmente segur@ de Anular la venta..?')) 
    {
      window.location.href="ventas/delete"+"/"+id;
    }
  }


var cont=0;
var detalles=0;
function agregarDetalle(idArticulo,nombre,precioVenta,precioCompra,stock){

    var cantidad=1;
    //var descuento=0;

    //alert(idArtRepetido(idArticulo));
    // No permite el ingreso de el mismo articulo 2 veces
    if (idArtRepetido(idArticulo)) {
      // false
      alert("El articulo ya esta en la lista");
    }else{
      //true
      
      if (idArticulo!="") {
    var subtotal=cantidad*precioVenta;
    //var utilidad=cantidad*(precioVenta-precioCompra);
    
    var fila='<tr class="filas1" id="fila'+cont+'">'+
            '<td><button type="button" class="btn-floating btn-small red" onclick="eliminarDetalle('+cont+')">X</button></td>'+
            '<td><input type="hidden" name="idArticulo[]" value="'+idArticulo+'"><input type="hidden" name="stock[]" value="'+stock+'"><input type="hidden" name="nombre[]" value="'+nombre+'">' + nombre + '</td>'+
            '<td><input class="form-control" type="number" step="5" min="0" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
            '<td><input class="form-control" type="number" min="0" readonly onmousedown="return false;" step="0.01"  name="precioVenta[]" id="precioVenta[]" value="'+precioVenta+'"></td><input type="hidden" name="precioCompra[]" id="precioCompra[]" value="'+precioCompra+'">'+
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

  
  var contnega=0;
  var contstocin=0;
function modificarSubtotales(){
    
    var cant=document.getElementsByName("cantidad[]");
    var prev=document.getElementsByName("precioVenta[]");
    var stoc=document.getElementsByName("stock[]");
    var nom=document.getElementsByName("nombre[]");
    //var prec=document.getElementsByName("precio_compra[]");//precio compra
    //var desc=document.getElementsByName("descuento[]");
    var sub=document.getElementsByName("subtotal");
    //var uti=document.getElementsByName("utilidad");

    // busca stock insuficiente
    for (var i = 0; i < cant.length; i++) {
        var c=parseInt(cant[i].value);
        var s=parseInt(stoc[i].value);
        if (s<c) {
          //alert(s+' < '+c);
          contstocin++;
          alert('Stock insuficiente: '+nom[i].value);
        }
    }


    // cuenta las cantidades negativas
    for (var i = 0; i < cant.length; i++) {
      var valor=cant[i].value;
        if (valor<0) {
          contnega++;
          alert('Cantidad Negativo: '+nom[i].value+'='+cant[i].value);
        }
    }

    // si existe stock insuficiente
    if (contstocin>0) {
      //alert('La cantidad debe ser mayor a CERO');
      contstocin=0;
    }else{
      // si hay catidades negativas salta alerta
    if (contnega>0) {
      //alert('La cantidad debe ser mayor a CERO');
      contnega=0;
    }else{
      
      for (var i = 0; i < cant.length; i++) {
        var inpV=cant[i];//cantidad
        var inpP=prev[i];//precio venta
        //var inpC=prec[i];//precio compra
        //var inpU=uti[i]; //utilidad
        var inpS=sub[i]; //sudtotal venta
        //var des=desc[i];

        //inpS.value=((inpV.value*inpP.value)-des.value);
        //inpU.value=inpV.value*(inpP.value-inpC.value);
        
        inpS.value=(inpV.value*inpP.value);
        
        //document.getElementsByName("utilidad")[i].innerHTML=inpU.value.toFixed(2);
        document.getElementsByName("subtotal")[i].innerHTML=inpS.value.toFixed(2);
    }
    }

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
    $("#totalVenta").val(total);

    //$("#totalUtilidad").html("Bs/." + utilidad.toFixed(2));
    //$("#utilidad_venta").val(utilidad);

    //evaluar();
}



function eliminarDetalle(indice){
$("#fila"+indice).remove();
calcularTotales();
detalles=detalles-1;

}

/*
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
        alert("No existe Cliente: "+ci);
      }

      
      
     
    })

  return false;
  }

*/

function selectCombo(){

    var tipoVenta=$("#cbxTipoVenta").val();
    var promoActiva=$("#txtPromoActiva").val();
    
    if (promoActiva=="Activada") {
     tipoVenta=2;
    }
    else if (tipoVenta==0) 
    {
      //alert('Venta al CONTADO');
    }
    else if(tipoVenta==1){
      //alert('Venta al CREDITO');
    }

    var id=$("#cbxPersona").val();
    if (id!=0) {
      // buscamos deuda del cliente
      $.ajax({
      url: 'ventas/buscarDeuda',
      type: 'POST',
      data:{id:id}
  }).done(function(data){
    var reg=eval(data);
    var totalDeuda= reg[0]['totalDeuda'];
    if (totalDeuda!=0) {
      alert("El Cliente debe: "+totalDeuda+" Bs.-");
    }
    
  });




        $.ajax({
      url: 'ventas/articulosPer',
      type: 'POST',
      data:{id:id}
  }).done(function(data){
    
    //alert(data);
    var reg=eval(data);

    if (reg.length>0) 
    {
        //var fila='';
        $("#tableEntel tbody").empty();
        $("#tableViva tbody").empty();
        $("#tableTigo tbody").empty();
      for (var i = 0; i<reg.length; i++) {
      var idArticulo=parseInt(reg[i]['idArticulo']);
      var precio=0;
      if (tipoVenta==0) {
        precio=parseFloat(reg[i]['precio']);
      }
      else if(tipoVenta==1){
        precio=parseFloat(reg[i]['precioCredito']);
      }else if(tipoVenta==2){
        precio=parseFloat(reg[i]['precioPromo']);
      }
      var precioCompra=parseFloat(reg[i]['precioCompra']);
      var stock=parseInt(reg[i]['stock']);
      var idEmpresa=parseInt(reg[i]['idEmpresa']);
      var nombreArt= reg[i]['nombre'];
      if (idEmpresa==1) {
      var fila='<tr>'+
                   '<td></td>'+
                   '<td>'+nombreArt+'</td>'+
                   '<td>'+stock+'</td>'+
                   '<td>'+precio+'</td>'+
                   '<td>'+
                      '<center>'+
                        '<a class="btn-floating btn-small cyan" onclick="agregarDetalle('+idArticulo+',\''+nombreArt+'\', '+precio+', '+precioCompra+', '+stock+')">'+
                        '<i class="large material-icons">add_circle</i>'+
                        '</a>'+
                      '</center>'+
                    '</td>'+
                '</tr>';
        $("#tableEntel tbody").append(fila);
        }

      if (idEmpresa==2) {
      var fila='<tr>'+
                   '<td></td>'+
                   '<td>'+reg[i]['nombre']+'</td>'+
                   '<td>'+reg[i]['stock']+'</td>'+
                   '<td>'+reg[i]['precio']+'</td>'+
                   '<td>'+
                      '<center>'+
                        '<a class="btn-floating btn-small cyan" onclick="agregarDetalle('+idArticulo+',\''+nombreArt+'\', '+precio+', '+precioCompra+', '+stock+')">'+
                        '<i class="large material-icons">add_circle</i>'+
                        '</a>'+
                      '</center>'+
                    '</td>'+
                '</tr>';
        $("#tableViva tbody").append(fila);
        }

      if (idEmpresa==3) {
      var fila='<tr>'+
                   '<td></td>'+
                   '<td>'+reg[i]['nombre']+'</td>'+
                   '<td>'+reg[i]['stock']+'</td>'+
                   '<td>'+reg[i]['precio']+'</td>'+
                   '<td>'+
                      '<center>'+
                        '<a class="btn-floating btn-small cyan" onclick="agregarDetalle('+idArticulo+',\''+nombreArt+'\', '+precio+', '+precioCompra+', '+stock+')">'+
                        '<i class="large material-icons">add_circle</i>'+
                        '</a>'+
                      '</center>'+
                    '</td>'+
                '</tr>';
        $("#tableTigo tbody").append(fila);
        }


    }
    
    }else{
      alert("El Cliente no tiene precios establecidos...");
    }
  });
//return false;

    }else{
        alert('Debe seleccionar CLIENTE');
    }

    
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
                                  <li class="tab col s3"><a class="active" href="#test2"><b>Nueva Venta</b>
                                    <li class="tab col s3"><a  href="#lista"><b>Lista Ventas</b></a></li>
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
                                                            <th>Cliente</th>
                                                            <th>Usuario</th>
                                                            <th>Total Venta</th>
                                                            <th>Tipo Venta</th>
                                                            <th>Estado</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        

                                                             <?php
                                              $indice=1;
                                              foreach($ventas->result() as $row) 
                                              {
                                               ?>
                                               <tr>
                                                 <td><?php echo $indice; ?></td>
                                                 <td><?php echo $row->fecha; ?></td>
                                                 <td><?php echo $row->persona; ?></td>
                                                 <td><?php echo $row->usuario; ?></td>
                                                 <td><?php echo $row->totalVenta; ?></td>
                                                 <td><?php 
                                                 $tipoVenta=$row->tipoVenta;
                                                 if ($tipoVenta==0) 
                                                  { echo "Contado";}
                                                else
                                                  { echo "Crédito";}
                                                   ?>
                                                  </td>
                                                 <td><?php 
                                                 $esta=$row->estado;
                                                 if ($esta==1) 
                                                  { echo "Activo";}
                                                else
                                                  { echo "Anulado";}
                                                   ?>
                                                  </td>
                                                 <td>
                                            <center>
                                                <a class="btn-floating btn-small red" onclick="preguntar(<?php echo $row->idVenta;?>)">
                                                <i class="large material-icons">close</i>
                                              </a>
                                              <a class="btn-floating btn-small cyan" href="<?php echo base_url('ventas/recibopdf')."/".$row->idVenta; ?>">
                                                <i class="large material-icons">print</i>
                                              </a>
                                              
                                              <a class="btn-floating btn-small cyan" href="<?php echo base_url('ventas/detalleArticulos')."/".$row->idVenta; ?>">
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
                                                            <th>Cliente</th>
                                                            <th>Usuario</th>
                                                            <th>Total Venta</th>
                                                            <th>Tipo Venta</th>
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
                                                        <li class="tab col s3"><a class="btn waves-effect waves-light light-green accent-3" href="#listaViva"><font color="White"><b>VIVA</b></font></a></li>
                                                        <li class="tab col s3"><a class="btn waves-effect waves-light indigo darken-3" href="#listaTigo"><font color="White"><b>TIGO</b></font></a></li>
                                                    </ul>
                                                </div>
<!--
                                                <div class="col s12 m6 l2">
                                                        <div class="input-field">
                                                        <input id="txtCiBuscar" name="txtCiBuscar" type="text" required>
                                                        <label for="l-name">Buscar CI</label>
                                                    </div>
                                                    
                                                </div>

                                                <div class="col s12 m6 l1">
                                                    <div class="input-field">
                                                        <button class="btn waves-effect waves-light cyan" onclick="return buscarCi()" id="btnBuscar"  name="btnBuscar"> <i class="fa fa-search"></i> </button>
                                                    </div>
                                                </div>
                                                

                                                <div class="col s12 m6 l2">
                                                    <div class="input-field">
                                                        <input  id="txtNombre" name="txtNombre" type="text" placeholder="Nombre" readonly="" required>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l2">
                                                    <div class="input-field">
                                                        <input  id="txtCi" name="txtCi" type="text" placeholder="Ci" readonly="" required>
                                                        
                                                    </div>
                                                </div>

                                                <input type="hidden" name="txtIdCliente" id="txtIdCliente">

                                                <div class="col s12 m6 l1">
                                                    <div class="input-field">
                                                        <a href="personas" class="btn waves-effect waves-light cyan"   on >Agregar</a>
                                                    </div>
                                                </div> // seleccion cliente cambio a combo

-->                                                
                                                  <div class="col s12 m6 l2">
                                                    <div class="input-field">
                                                        <select onchange="selectCombo()" id="cbxTipoVenta" name="cbxTipoVenta" <?php if ($promoActiva==1) {
                                                          echo "disabled";
                                                        }?>>
                                                              <option value="0">Contado</option>
                                                              <option value="1">Crédito</option>
                                                        </select> 
                                                        <label for="email1"><b>Contado o Crédito</b></label>
                                                    </div>
                                                  </div>
                                                  <div class="col s12 m6 l4">
                                                    <div class="input-field">
                                                        <select onchange="selectCombo()" id="cbxPersona" name="cbxPersona" >
                                                          <option value="0">Selecione Cliente</option>
                                                              <?php
                                                          foreach($personas->result() as $row) 
                                                          {
                                                           ?>
                                                            <option value="<?php echo $row->idPersona; ?>"><?php echo $row->nombre.' '.$row->primerApellido.' '.$row->segundoApellido; ?></option>
                                                            <?php 
                                                          }
                                                          ?>
                                                        </select> 
                                                        <label for="email1"><b>Cliente</b></label>
                                                    </div>
                                                  </div>
                                                  <div class="col s12 m6 l2">
                                                    <div class="input-field">
                                                        <input type="text" name="txtPromoActiva" id="txtPromoActiva" value="<?php 
                                                        if($promoActiva==0){
                                                          echo "Desactivada";
                                                        }else{
                                                          echo "Activada";
                                                        }
                                                        ?>" readonly>
                                                        <label for="email1"><b>Promo</b></label>
                                                    </div>
                                                  </div>

                                            </div>
                                            <div class="row">
                                                <div class="col s12 m6 l4">
                                                    <!--inicio tabla articulos -->
                                                    <div id="listaEntel" class="col s12">
                                                    <table id="tableEntel" class="table table-striped table-bordered display">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Precio</th>
                                                            <th>Opcion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody >
       
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Precio</th>
                                                            <th>Opcion</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                </div>
                                                    <!--fin tabla articulos -->
                                                    <!--inicio tabla articulos Viva -->
                                                  <div id="listaViva" class="col s12">
                                                        <table id="tableViva" class="table table-striped table-bordered display">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Precio</th>
                                                            <th>Opcion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                   
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Precio</th>
                                                            <th>Opcion</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                    </div> 
                                                    <!--fin tabla articulos Viva -->
                                                    <!--inicio tabla articulos Tigo -->
                                                    <div id="listaTigo" class="col s12">
                                                        <table id="tableTigo" class="table table-striped table-bordered display">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Precio</th>
                                                            <th>Opcion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th></th>
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Precio</th>
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
                                                       <thead style="background-color:#A9D0F5">
                                                        <th>Opciones</th>
                                                        <th>Articulo</th>
                                                        <th >Cantidad</th>
                                                        <th >Precio</th>
                                                        <th>Subtotal</th>
                                                    
                                                       </thead>

                                                       <tfoot style="background-color:#A9D0F5">
                                                         <th></th>
                                                         <th></th>
                                                         
                                                         <th>TOTAL</th>
                                                         <th><h4 id="total">Bs/. 0.00</h4><input type="hidden" name="totalVenta" id="totalVenta"></th>
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
                                                                <a class="btn waves-effect waves-light grey darken-4" href="<?php echo base_url('ventas'); ?>" ><i class="fa fa-arrow-circle-left"></i> Cancelar
                                                                </a>
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


