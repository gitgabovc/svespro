
<?php 
//print_r($articulos->result());
    if ($this->session->userdata('Personas')==1) {
?>


<!---script de confirmacion para delete-->
<script type="text/javascript">
  function preguntar(id){

    if (confirm('¿Esta realmente segur@ de Eliminar?')) 
    {
      window.location.href="personas/delete"+"/"+id;

    }
  }




function selectCombo(){
    var id=$("#").val();
    if (id!=0) {

        $.ajax({
      url: 'precios/listarArticulos',
      type: 'POST',
      data:{id:id}
  }).done(function(data){
    
    //alert(data);
    var reg=eval(data);

    if (reg.length>0) 
    {
        $("#caracteristicas").empty ();
      for (var i = 0; i<reg.length; i++) {
    
      var fila='<div class="input-field"><input type="hidden" id="idNombreCarac[]" name="idNombreCarac[]" value="'+reg[i]['idNombreCarac']+'"></div><div class="col s12 m6 l2"><div class="input-field"><input id="txtNombreCarac[]" name="txtNombreCarac[]" type="text" value="'+reg[i]['nombreCarac']+'" readonly></div></div><div class="col s12 m6 l4"><div class="input-field"><input id="txtDescripcionCarac[]" name="txtDescripcionCarac[]" type="text" placeholder="Característica"></div></div>';

    $('#caracteristicas').append(fila);    
    }
    }else{
      alert("No existe caracteristicas ");
    }
  });
//return false;

    }else{
        alert('Debe seleccionar CATEGORIA');
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
                                    <li class="tab col s3"><a class="active" href="#lista"><b>Lista</b></a></li>
                                    <li class="tab col s3"><a href="#test2"><b>Agregar</b></a></li>
                                    <li class="tab col s3"><a href="#test4">...</a></li>
                                </ul>
                            </div>
                            <div id="lista" class="col s12">
                                
                    <!-- inicio tabla lista -->
                        <div class="divider"></div>

                                <table id="file_export" class="table table-striped table-bordered display">
                                                    <thead>
                                                        <tr>
                                                            <th>Nro</th>
                                                            <th>Nombre</th>
                                                            <th>Editar Precios</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        

                                                             <?php
                                              $indice=1;
                                              foreach($personas->result() as $row) 
                                              {
                                               ?>
                                               <tr>
                                                 <td><?php echo $indice; ?></td>
                                                 <td><?php echo $row->nombre.' '.$row->primerApellido.' '.$row->segundoApellido; ?></td>
                                                 <td>
                                            
                                              <a class="btn-floating btn-small cyan" href="<?php echo base_url('precios/edit')."/".$row->idPersona; ?>">
                                                <i class="large material-icons">mode_edit</i>
                                              </a>
                                            
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
                                                            <th>Nombre</th>
                                                            <th>Editar Precios</th>
                                                        </tr>
                                                    </tfoot>
                                    </table>
                        <div class="divider"></div>
                    <!-- final tabla lista -->

                            </div>
                            <div id="test2" class="col s12">
                    <!-- inicio form agregar --> 
                                <form action="" name="formDatos" id="formDatos" method="POST">
                                    <div class="form-body">
                                        <div class="divider"></div>

                                        <div class="card-content">
                                            <h6 class="font-medium">Agregar Precios</h6>
                                            
                                            <div class="row">
                                                <div class="col s12 m6 l3">
                                                    <div class="input-field">
                                                        <select  id="cbxCliente" name="cbxCliente" required>
                                                            <option value="0">Seleccione</option>
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
                                            </div>
                                          
                                            <div class="divider"></div>
                                                    <div class="row">
                                                      <div class="col s12 m6 l8">
                                                        
                                                        <div class="col s12 m6 l3">
                                                            <div class="input-field">
                                                                <h6>Articulos</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                            <div class="input-field">
                                                                <h6>Precio Normal</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                            <div class="input-field">
                                                                <h6>Precio a Crédito</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                            <div class="input-field">
                                                                <h6>Precio Promo</h6>
                                                            </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                                          
                                                <?php
                                                    foreach($articulos->result() as $row) { ?>
                                                    <div class="row">
                                                      <div class="col s12 m6 l8">
                                                        <div class="input-field"><input type="hidden" id="idArticulo[]" name="idArticulo[]" value="<?php echo $row->idArticulo; ?>">
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                          <div class="input-field"><input id="txtNombreArticulo[]" name="txtNombreArticulo[]" type="text" value="<?php echo $row->nombre; ?>" readonly>
                                                          </div>
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                          <div class="input-field"><input id="txtPrecio[]" name="txtPrecio[]" type="number" step="0.0001" value="<?php echo $row->precioVenta; ?>">
                                                          </div>
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                          <div class="input-field"><input id="txtPrecioCredito[]" name="txtPrecioCredito[]" type="number" step="0.0001" value="<?php echo $row->precioVenta; ?>">
                                                          </div>
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                          <div class="input-field"><input id="txtPrecioPromo[]" name="txtPrecioPromo[]" type="number" step="0.0001" value="<?php echo $row->precioVenta; ?>">
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                <?php } ?>
                                                         
                                            
                                            
                                        </div>
                                       
                                        <div class="divider"></div>
                                        <div class="card-content">
                                            <div class="form-action">
                                                <button class="btn waves-effect waves-light cyan" id="btnGuardar"  name="btnGuardar"> <i class="fa fa-save"></i> Guardar
                                                </button>
                                                <button class="btn waves-effect waves-light grey darken-4" id="btnCancelar" type="submit" name="action"><i class="fa fa-arrow-circle-left"></i> Cancelar
                                                </button>
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