
<?php 
    if ($this->session->userdata('Almacen')==1) {
?>

<!---script de confirmacion para delete-->
<script type="text/javascript">
  function preguntar(id){
    if (confirm('¿Esta realmente segur@ de Eliminar?')) 
    {
      window.location.href="articulos/delete"+"/"+id;

    }
  }


  function calcularUtilidad() {

    var precioNormal=document.getElementsByName("txtPrecioNormal[]");
    var precioPromo=document.getElementsByName("txtPrecioPromo[]");
    var cantidad=document.getElementsByName("txtCantidad[]");
    var utilidad=0;
    for (var i = 0; i <precioNormal.length; i++) {

        utilidad += (precioNormal[i].value-precioPromo[i].value)*cantidad[i].value;
        //alert(precioNormal[i].value);
    }
    
    //alert(utilidad);
    
    $('#totalUtilidad').val(utilidad.toFixed(2));
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
                                    
                                    <li class="tab col s3"><a href="#agregar"><b>Agregar</b></a></li>
                                    
                                </ul>
                            </div>
                            
                            <div id="agregar" class="col s12">
                    <!-- inicio form agregar --> 
                                <form action="calculadora/insert" name="articuloDatos" id="articuloDatos" method="POST">
                                    <div class="form-body">
                                        
                                        <h6 class="font-medium">Calcular Descuento Dia PROMO</h6>
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
                                                                <h6>Precio Promo</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                            <div class="input-field">
                                                                <h6>Cantidad</h6>
                                                            </div>
                                                        </div>
                                                      </div>


                                                      


                                        </div>
                                        <div class="divider"></div>
                                        <div class="card-content">
                                            <div class="row">
                                             <div class="col s12 m6 l8">
                                            <?php
                                              foreach($artEntel->result() as $row) 
                                              {
                                               ?>
                                            
                                                        <div class="input-field"><input type="hidden" id="idArticulo[]" name="idArticulo[]" value="<?php echo $row->idArticulo; ?>">
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                          <div class="input-field"><input id="txtNombreArticulo[]" name="txtNombreArticulo[]" type="text" value="<?php echo $row->nombre; ?>" readonly>
                                                          </div>
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                          <div class="input-field"><input id="txtPrecioNormal[]" name="txtPrecioNormal[]" type="number" step="0.0001" value="<?php echo $row->precioCompra; ?>" readonly>
                                                          </div>
                                                        </div>
                                                       <div class="col s12 m6 l3">
                                                          <div class="input-field"><input id="txtPrecioPromo[]" name="txtPrecioPromo[]" type="number" step="0.01" value="<?php echo $row->precioCompra; ?>">
                                                          </div>
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                          <div class="input-field"><input id="txtCantidad[]" name="txtCantidad[]" type="number" step="1" value="Cantidad">
                                                          </div>
                                                        </div>
                                                      
                                            <?php 
                                              }
                                              ?>

                                                </div>
                                                <div class="col s12 m6 l4">
                                                    <a class="btn waves-effect waves-light cyan" onclick="calcularUtilidad()"  > <i class="fa fa-calulate"></i> Calcular
                                                    </a>
                                                    <div class="input-field"><input type="number" id="totalUtilidad" name="totalUtilidad" value="0" readonly>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                       
                                        <div class="divider"></div>
                                        <div class="card-content">
                                            <div class="form-action">
                                                <button class="btn waves-effect waves-light cyan" id="btnGuardar"  name="btnGuardar"> <i class="fa fa-save"></i> Guardar
                                                </button>
                                                <a class="btn waves-effect waves-light grey darken-4" id="btnCancelar" href="<?php echo base_url();?>capital" type="submit" name="action"><i class="fa fa-arrow-circle-left"></i> Cancelar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                    <!-- final form agregar -->
                            </div>


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