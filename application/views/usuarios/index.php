
<?php 
    if ($this->session->userdata('Personas')==1) {
?>


<!---script de confirmacion para delete-->
<script type="text/javascript">
  function preguntar(id){

    if (confirm('¿Esta realmente segur@ de Eliminar?')) 
    {
      window.location.href="usuarios/delete"+"/"+id;

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
                                                            <th>Imagen</th>
                                                            <th>Nombre</th>
                                                            <th>Cargo</th>
                                                            <th>Nro Documento</th>
                                                            <th>Login</th>
                                                            <th>Dirección</th>
                                                            <th>Teléfono</th>
                                                            <th>Email</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        

                                                             <?php
                                              
                                              foreach($usuarios->result() as $row) 
                                              {
                                               ?>
                                               <tr>
                                                 <td><div class="u-img"><img src="<?php echo base_url();?><?php echo $row->imagen;?>" width="75" height="75" alt="user"></div></td>
                                                 <td><?php echo $row->nombre.' '.$row->primerApellido.' '.$row->segundoApellido; ?></td>
                                                 <td><?php echo $row->cargo; ?></td>
                                                 <td><?php echo $row->numDocumento; ?></td>
                                                 <td><?php echo $row->login; ?></td>
                                                 <td><?php echo $row->direccion; ?></td>
                                                 <td><?php echo $row->telefono; ?></td>
                                                 <td> <?php echo $row->email; ?></td>
                                                 <td>
                                            <center>
                                              <a class="btn-floating btn-small red" onclick="preguntar(<?php echo $row->idUsuario;?>)">
                                                <i class="large material-icons">delete_forever</i>
                                              </a>
                                              <a class="btn-floating btn-small cyan" href="<?php echo base_url('usuarios/edit')."/".$row->idUsuario; ?>">
                                                <i class="large material-icons">mode_edit</i>
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
                                                            <th>Imagen</th>
                                                            <th>Nombre</th>
                                                            <th>Cargo</th>
                                                            <th>Nro Documento</th>
                                                            <th>Login</th>
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
                                <form action="usuarios/insert" name="usuarioDatos" id="usuarioDatos" method="POST" enctype="multipart/form-data" >
                                    <div class="form-body">
                                        <div class="divider"></div>

                                        <div class="card-content">
                                            <h6 class="font-medium">Agregar Persona</h6>
                                            <div class="row">
                                                <div class="col s12 m6 l4">
                                                    <div class="input-field">
                                                        <input id="txtNombre" name="txtNombre" type="text" required>
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
                                                <div class="col s12 m6 l4">
                                                    <div class="input-field">
                                                        <select id="cbxTipoDocumento" name="cbxTipoDocumento">
                                                            <option value="Cedula">Cedula de Identidad</option>
                                                            <option value="Pasaporte">Pasaporte</option>
                                                            <option value="Libreta S.M.">Libreta S. Militar</option>
                                                        </select> 
                                                        <label for="email1"><b>Tipo de Documento</b></label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l4">
                                                    <div class="input-field">
                                                        <input id="txtNumDocumento" name="txtNumDocumento"  type="text">
                                                        <label for="con1"><b>Número de Documento</b></label>
                                                    </div>
                                                </div>
                                                 <div class="col s12 m6 l4">
                                                    <div class="input-field">
                                                        <select  id="cbxCargo" name="cbxCargo">
                                                            <option value="Administrador">Administrador</option>
                                                            <option value="Empleado">Empleado</option>
                                                        </select> 
                                                        <label for="email1"><b>Cargo</b></label>
                                                    </div>
                                                </div>
                                            </div>
                                          
                                            <div class="row">
                                                <div class="col s12 m6 l5">
                                                    <div class="input-field">
                                                        <input id="txtDireccion" name="txtDireccion" type="text">
                                                        <label for="email1"><b>Dirección</b></label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l3">
                                                    <div class="input-field">
                                                        <input id="txtTelefono" name="txtTelefono" type="number">
                                                        <label for="email1"><b>Teléfono</b></label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l4">
                                                    <div class="input-field">
                                                        <input id="txtEmail" name="txtEmail"  type="text">
                                                        <label for="con1"><b>Correo Electrónico</b></label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col s12 m6 l4">
                                                    <div class="input-field">
                                                        <input id="txtLogin" name="txtLogin" type="text" required>
                                                        <label for="f-name"><b>Login</b></label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l4">
                                                    <div class="input-field">
                                                        <input id="txtClave" name="txtClave" type="password" required>
                                                        <label for="l-name"><b>Clave</b></label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l4">
                                                    <div class="file-field input-field">
                                                        <div class="btn cyan">
                                                            <span>Imagen</span>
                                                            <input type="file" id="imagen" name="imagen">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text" name="txtImagen" id="txtImagen">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        
                                        

                                        <h6 class="font-medium">Agregar Permisos</h6>
                                        <div class="divider"></div><br>
                                        <div class="row">

                                            <div class="col s12 m6 l4">

                                            <?php
                                              
                                              foreach($permisos->result() as $row) 
                                              {
                                               ?>

                                                <p>
                                                    <label>
                                                        <input value="<?php echo $row->idPermiso; ?>" type="checkbox" class="filled-in"  name="checkIdPermiso[]" />
                                                        <span><?php echo $row->nombre; ?></span>
                                                    </label>
                                                </p>

                                                <?php 
                                              }
                                            ?>

                                            </div>

                                        </div>
                                    </div>
                                       
                                        <div class="divider"></div>
                                        <div class="card-content">
                                            <div class="form-action">
                                                <button class="btn waves-effect waves-light cyan" id="btnGuardar"  name="btnGuardar"> <i class="fa fa-save"></i> Guardar
                                                </button>
                                                <a class="btn waves-effect waves-light grey darken-4" id="#" name="#" href="<?php echo base_url('usuarios'); ?>"><i class="fa fa-arrow-circle-left"></i> Cancelar
                                                </a>
                                                
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