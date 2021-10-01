
<?php 
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
                                                            <th>Nro Documento</th>
                                                            <th>Dirección</th>
                                                            <th>Teléfono</th>
                                                            <th>Email</th>
                                                            <th>Acciones</th>
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
                                                 <td><?php echo $row->numDocumento; ?></td>
                                                 <td><?php echo $row->direccion; ?></td>
                                                 <td><?php echo $row->telefono; ?></td>
                                                 <td> <?php echo $row->email; ?></td>
                                                 <td>
                                            <center>
                                              <a class="btn-floating btn-small red" onclick="preguntar(<?php echo $row->idPersona;?>)">
                                                <i class="large material-icons">delete_forever</i>
                                              </a>
                                              <a class="btn-floating btn-small cyan" href="<?php echo base_url('personas/edit')."/".$row->idPersona; ?>">
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
                                                            <th>Nro Documento</th>
                                                            <th>Dirección</th>
                                                            <th>Teléfono</th>
                                                            <th>Email</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </tfoot>
                                    </table>
                        <div class="divider"></div>
                    <!-- final tabla lista -->

                            </div>
                            <div id="test2" class="col s12">
                    <!-- inicio form agregar --> 
                                <form action="" name="personaDatos" id="personaDatos" method="POST">
                                    <div class="form-body">
                                        <div class="divider"></div>

                                        <div class="card-content">
                                            <h6 class="font-medium">Agregar Persona</h6>
                                            <div class="row">
                                                <div class="col s12 m6 l4">
                                                    <div class="input-field">
                                                        <input id="txtNombre" name="txtNombre" type="text">
                                                        <label for="f-name"><b>Nombre</b></label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l4">
                                                    <div class="input-field">
                                                        <input id="txtPrimerApellido" name="txtPrimerApellido" type="text">
                                                        <label for="l-name"><b>Apellido Paterno</b></label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l4">
                                                    <div class="input-field">
                                                        <input id="txtSegundoApellido" name="txtSegundoApellido" type="text">
                                                        <label for="l-name"><b>Apellido Materno</b></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <select id="cbxTipoDocumento" name="cbxTipoDocumento">
                                                            <option value="Cedula">Cedula de Identidad</option>
                                                            <option value="Pasaporte">Pasaporte</option>
                                                            <option value="Libreta S.M.">Libreta S. Militar</option>
                                                        </select> 
                                                        <label for="email1"><b>Tipo de Documento</b></label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtNumDocumento" name="txtNumDocumento"  type="text">
                                                        <label for="con1"><b>Número de Documento</b></label>
                                                    </div>
                                                </div>
                                            </div>
                                          
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtDireccion" name="txtDireccion" type="text">
                                                        <label for="email1"><b>Dirección</b></label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtTelefono" name="txtTelefono" type="text">
                                                        <label for="email1"><b>Teléfono</b></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtEmail" name="txtEmail"  type="text">
                                                        <label for="con1"><b>Correo Electrónico</b></label>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            
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