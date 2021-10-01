
<?php 
    if ($this->session->userdata('Reportes')==1) {
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

<style type="text/css">
  #montos {
    min-height:50px;
    background:#3DE6AF;
}

  #texto {
    text-decoration-color: white;   
}





</style>



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
                          <div class="col s12 m6 l2">
                              <div class="input-field">
                                  <input type="date" class="form-control" id="dtpFechaInicio" name="dtpFechaInicio" step="1" min="2019-01-01" value="<?php echo date("Y-m-d");?>">
                                  <label for="email1">Fecha Inicio</label>
                              </div>
                          </div>
                          <div class="col s12 m6 l2">
                              <div class="input-field">
                                  <input type="date" class="form-control" id="dtpFechaFinal" name="dtpFechaFinal" step="1" min="2019-01-01" value="<?php echo date("Y-m-d");?>">
                                  <label for="email1">Fecha Final</label>
                              </div>
                          </div>

                          <div class="col s12 m6 l2">
                              <div class="input-field">
                                  <select id="cbxTipoReporte" name="cbxTipoReporte">
                                      <option value="1">Global</option>
                                      <option value="2">Por Artículos</option>
                                  </select> 
                                  <label for="email1"><b>Tipo de Reporte</b></label>
                              </div>
                          </div>

                          <div class="col s12 m6 l2">
                              <div class="input-field">
                                  <button class="btn waves-effect waves-light cyan" id="btnMostrar"  name="btnMostrar"> <i class="fa fa-eye"></i> Mostrar</button>
                              </div>
                          </div>
                          
                          <div class="col s12 m6 l2">
                              <div class="input-field">
                                  <a class="btn waves-effect waves-light cyan" id="btnGenerar"  name="btnGenerar"> <i class="fa fa-print"></i> Generar</a>
                              </div>
                          </div>
                          <!--
                          <div class="col s12 m6 l2">
                            <div id="montos" >
                              <div class="input-field">
                                  <label><FONT COLOR="White">Movimiento :</FONT>
                                  </label>
                                  <label id="total" name="total" ><FONT COLOR="White"></FONT>
                                  </label>
                              </div>
                            </div>

                          </div>
                        -->
                      </div>
              
                        <div class="row">

                           
                            <div id="lista" class="col s12">
                                
                    <!-- inicio tabla lista -->
                        <div class="divider"></div>

                                <table id="file_export" class="table table-striped table-bordered display">
                                                    
                                          <!-- Aqui mando contenido desde java script -->         
                                </table>
                        <div class="divider"></div>
                    <!-- final tabla lista -->

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
            

<script type="text/javascript">
  var baseurl="<?php echo base_url(); ?>";
</script>


