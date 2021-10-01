
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
                                    
                                    <li class="tab col s3"><a href="#agregar"><b>modificar</b></a></li>
                                    
                                </ul>
                            </div>
                            
                            <div id="agregar" class="col s12">
                    <!-- inicio form agregar --> 
                                <form action="diapromo/modificar" name="articuloDatos" id="articuloDatos" method="POST">
                                    <div class="form-body">
                                        <br>
                                        <h6 class="font-medium">Activar y Descativar dia PROMO</h6>
                                        <div class="row">
                                                      <div class="col s12 m6 l8">
                                                        
                                                       
                                                      </div>


                                                      


                                        </div>
                                        <div class="divider"></div>
                                        <div class="card-content">
                                            <div class="row">
                                             
                                             <h3><?php 
                                                if ($promoActiva==0) {
                                                    echo "DESACTIVADA";
                                                }else{
                                                    echo "ACTIVADA";  
                                                }
                                             ?></h3>
                                               
                                            </div>
                                                <input type="hidden" name="txtpromoActiva" id="txtpromoActiva" value="<?php echo $promoActiva; ?>">
                                        </div>
                                       
                                        <div class="divider"></div>
                                        <div class="card-content">
                                            <div class="form-action">
                                                <button class="btn waves-effect waves-light cyan" id="btnGuardar"  name="btnGuardar"> <i class="fa fa-save"></i> Modificar
                                                </button>
                                                <a class="btn waves-effect waves-light grey darken-4" id="btnCancelar" href="<?php echo base_url();?>tablero" type="submit" name="action"><i class="fa fa-arrow-circle-left"></i> Cancelar
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