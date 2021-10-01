
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
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Precio Compra</th>
                                                            <th>Precio Venta</th>
                                                            <th>Empresa</th>
                                                            <th>Descripcion</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        

                                                             <?php
                                              $indice=1;
                                              foreach($articulos->result() as $row) 
                                              {
                                               ?>
                                               <tr>
                                                 <td><?php echo $indice; ?></td>
                                                 <td><?php echo $row->nombre; ?></td>
                                                 <td><?php echo $row->stock; ?></td>
                                                 <td><?php echo $row->precioCompra; ?></td>
                                                 <td><?php echo $row->precioVenta; ?></td>
                                                 <td><?php echo $row->nombreEmpresa; ?></td>
                                                 <td> <?php echo $row->descripcion; ?></td>
                                                 <td>
                                            <center>
                                                <a class="btn-floating btn-small red" onclick="preguntar(<?php echo $row->idArticulo;?>)">
                                                <i class="large material-icons">delete_forever</i>
                                              </a>
                                              <a class="btn-floating btn-small cyan" href="<?php echo base_url('articulos/edit')."/".$row->idArticulo; ?>">
                                                <i class="large material-icons">mode_edit</i>
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
                                                            <th>Nombre</th>
                                                            <th>Stock</th>
                                                            <th>Precio Compra</th>
                                                            <th>Precio Venta</th>
                                                            <th>Empresa</th>
                                                            <th>Descripcion</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </tfoot>
                                    </table>
                        <div class="divider"></div>
                    <!-- final tabla lista -->

                            </div>
                            <div id="agregar" class="col s12">
                    <!-- inicio form agregar --> 
                                <form action="" name="articuloDatos" id="articuloDatos" method="POST">
                                    <div class="form-body">
                                        <div class="divider"></div>
                                        <div class="card-content">
                                            <h6 class="font-medium">Agregar Artículo</h6>
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtNombre" name="txtNombre" type="text" required>
                                                        <label for="l-name">Nombre</label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtPrecioCompra" name="txtPrecioCompra" type="number" step="0.01" required>
                                                        <label for="l-name">Precio Compra</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtStock" name="txtStock" type="number" min="0" required>
                                                        <label for="l-name">Stock</label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtPrecioVenta" name="txtPrecioVenta"  type="number" step="0.01" required>
                                                        <label for="con1">Precio Venta</label>
                                                    </div>
                                                </div>
                                            </div>
                                          
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <select id="cbxEmpresa" name="cbxEmpresa">
                                                              <?php
                                                          foreach($empresas->result() as $row1) 
                                                          {
                                                           ?>
                                                            <option value="<?php echo $row1->idEmpresa; ?>"><?php echo $row1->nombreEmpresa; ?></option>
                                                            <?php 
                                                          }
                                                          ?>
                                                        </select> 
                                                        <label for="email1"><b>Empresa</b></label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtDescripcion" name="txtDescripcion" type="text">
                                                        <label for="email1">Descripción</label>
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
                                                <a class="btn waves-effect waves-light grey darken-4" id="btnCancelar" href="<?php echo base_url();?>articulos" type="submit" name="action"><i class="fa fa-arrow-circle-left"></i> Cancelar
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