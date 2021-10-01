
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
                                    <li class="tab col s3"><a class="active" href="#lista"><b>Lista</b></a></li>
                                    <li class="tab col s3"><a href="#agregar"><b>Agregar</b></a></li>
                                    
                                </ul>
                            </div>
                            <div id="lista" class="col s12">
                                
                    <!-- inicio tabla lista -->
                        <div class="divider"></div>

                                <table id="file_export" class="table table-striped table-bordered display">
                                                    <thead>
                                                        <tr>
                                                            <th>Nro</th>
                                                            <th>Monto</th>
                                                            <th>Descripcion</th>
                                                            <th>Cap. Anterior</th>
                                                            <th>Cap. Actual</th>
                                                            <th>Fecha</th>
                                                            <th>Usuario</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        

                                                             <?php
                                              $indice=1;
                                              foreach($movimientos->result() as $row) 
                                              {
                                               ?>
                                               <tr>
                                                 <td><?php echo $indice; ?></td>
                                                 <td><?php echo $row->monto; ?></td>
                                                 <td><?php echo $row->descripcion; ?></td>
                                                 <td><?php echo $row->capitalAnterior; ?></td>
                                                 <td><?php echo $row->capitalActual; ?></td>
                                                 <td><?php echo $row->fecha; ?></td>
                                                 <td><?php echo $row->nombre.' '.$row->primerApellido; ?></td>
                                                 <td>
                                            <center>
                                                <!--
                                              <a class="btn-floating btn-small cyan" href="<?php echo base_url('articulos/edit')."/".$row->idArticulo; ?>">
                                                <i class="large material-icons">mode_edit</i>
                                              </a>
                                                -->
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
                                                            <th>Monto</th>
                                                            <th>Descripcion</th>
                                                            <th>Cap. Anterior</th>
                                                            <th>Cap. Actual</th>
                                                            <th>Fecha</th>
                                                            <th>Usuario</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </tfoot>
                                    </table>
                        <div class="divider"></div>
                    <!-- final tabla lista -->

                            </div>
                            <div id="agregar" class="col s12">
                    <!-- inicio form agregar --> 
                                <form action="capital/insert" name="articuloDatos" id="articuloDatos" method="POST">
                                    <div class="form-body">
                                        <div class="divider"></div>
                                        <div class="card-content">
                                            <h6 class="font-medium">Administrar Capital</h6>
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtMonto" name="txtMonto" type="number" step="0.01" required>
                                                        <label for="l-name">Monto</label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtDescripcion" name="txtDescripcion" type="text" min="0" maxlength="200" required>
                                                        <label for="l-name">Descripcion</label>
                                                    </div>
                                                </div>

                                            </div>
                                          
                                          
                                       
<!--
                                            <div class="row">
                                                <div class="col s12 m6 l6">       
                                                    <div class="file-field input-field">
                                                        <div class="btn cyan">
                                                            <span>Imagen</span>
                                                            <input type="file" name="Imagen">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text">
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
-->
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