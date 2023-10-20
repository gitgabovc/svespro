<!-- <?php
      //if ($this->session->userdata('usuario')) {
      ?> -->

<!---script de confirmacion para delete-->
<script type="text/javascript">
  function deleteConfirm(id) {
    if (confirm('¿Esta realmente segur@ de Eliminar?')) {
      window.location.href = "empleado/delete" + "/" + id;

    }
  }
</script>



<?php
//print_r($cliente->result());

?>

<!-- content-->
<div class="row">

  <div class="col-lg-12">

    <!-- Tabs -->
    <ul class="nav nav-lg nav-tabs nav-left no-margin no-border-radius   border-top border-top-indigo-100">
      <li class="active">
        <a href="#messages-tue" class="text-size-small text-uppercase bg-gray-100" data-toggle="tab">
          lista
        </a>
      </li>

      <li>
        <a href="#messages-mon" class="text-size-small text-uppercase bg-gray-100" data-toggle="tab">
          agregar
        </a>
      </li>

    </ul>
    <!-- /tabs -->
    <!-- Tabs content -->
    <div class="tab-content">
      <div class="tab-pane active " id="messages-tue">
        <!-- Basic datatable -->
        <div class="panel panel-flat">
<div class="table-responsive">

          <table class="table datatable-basic">
            <thead>
              <tr>
                <th>Nº</th>
                <th>Foto</th>
                <th>Nombre Completo</th>

                <th>F. Nacimiento</th>
                <th>C.I.</th>
                <th>Sexo</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th>Tipo</th>
                <th>Acceso</th>

                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $indice = 1;
              foreach ($empleado->result() as $row) {
              ?>
                <tr>
                  <td><?php echo $indice; ?></td>
                  <td><?php echo fotoUsuario($row->foto); ?></td>
                  <td><?php echo strtoupper($row->nombres . " " .
                        $row->primerApellido . " " .
                        $row->segundoApellido) ?></td>
                  <td><?php echo $row->fechaNacimiento; ?></td>
                  <td><?php echo $row->carnetIdentidad; ?></td>
                  <td><?php echo $row->sexo; ?></td>
                  <td><?php echo $row->telefono; ?></td>
                  <td><?php echo $row->email; ?></td>
                  <td><?php echo $row->usuario; ?></td>
                  <td><?php echo $row->password; ?></td>
                  <td><?php echo cambiarTipo($row->tipo); ?></td>
                  <td class="<?php echo ($row->acceso == "1")? "text-success" : "text-danger" ?>"><?php echo cambiarAcceso($row->acceso); ?></td>
                  <td class="text-center">
                    <ul class="icons-list">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="icon-menu9"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                          <li><a href="<?php echo base_url('empleado/edit') . "/" . $row->idEmpleado; ?>"><i class="icon-pencil5"></i> Modificar</a></li>
                          <li><a href="<?php echo base_url('empleado/cambiarAcceso') . "/" . $row->idEmpleado."/" .$row->acceso; ?>"><i class="icon-file-pdf"></i> Cambiar Acceso</a></li>
                          <li><a href="#" onclick="deleteConfirm(<?php echo $row->idEmpleado; ?>)"><i class="icon-bin"></i> Eliminar</a></li>
                        </ul>
                      </li>
                    </ul>
                  </td>
                </tr>
              <?php
                $indice++;
              } ?>
            </tbody>
          </table>
</div>

        </div>
        <!-- /basic datatable -->
      </div>

      <div class="tab-pane" id="messages-mon">
        <!-- Form horizontal -->
        <div class="panel panel-flat">

          <div class="panel-body">

            <form class="form-horizontal" action="" name="FormDatos" id="FormDatos" method="POST">

              <fieldset class="content-group">
                <div class="form-group">
                  <div class="col-lg-10">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group has-feedback has-feedback-left">
                          <input type="text" class="form-control input-xlg" placeholder="Nombres" id="txtNombres" name="txtNombres">
                          <div class="form-control-feedback">
                            <i class="icon-office"></i>
                          </div>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                          <input type="text" class="form-control input-lg" placeholder="Apellido Paterno" id="txtPrimerApellido" name="txtPrimerApellido">
                          <div class="form-control-feedback">
                            <i class="icon-make-group"></i>
                          </div>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                          <input type="text" class="form-control input-lg" placeholder="Apellido Materno" id="txtSegundoApellido" name="txtSegundoApellido">
                          <div class="form-control-feedback">
                            <i class="icon-make-group"></i>
                          </div>
                        </div>
                        <div class="form-group has-feedback has-feedback-left">
                          <input type="text" class="form-control input-lg" placeholder="Fecha Nacimiento" id="txtFechaNacimiento" name="txtFechaNacimiento">
                          <div class="form-control-feedback">
                            <i class="icon-make-group"></i>
                          </div>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                          <input type="number" class="form-control" placeholder="Numero de carnet" id="txtCarnetIdentidad" name="txtCarnetIdentidad">
                          <div class="form-control-feedback">
                            <i class="icon-droplets"></i>
                          </div>
                        </div>


                        <div class="form-group has-feedback has-feedback-left">
                          <select class="bootstrap-select" data-width="100%" id="cbxSexo" name="cbxSexo">
                            <option value="" disabled selected>---- Seleccionar Genero --</option>
                            <option value="m">----- Masculito</option>
                            <option value="f">----- Femenino</option>


                          </select>
                          <div class="form-control-feedback">
                            <i class="icon-droplets"></i>
                          </div>
                        </div>
                        <div class="form-group has-feedback has-feedback-left">
                          <input type="number" class="form-control" placeholder="Numero de telefono" id="txtTelefono" name="txtTelefono">
                          <div class="form-control-feedback">
                            <i class="icon-droplets"></i>
                          </div>
                        </div>





                        <div class="form-group has-feedback has-feedback-left">
                          <input type="text" class="form-control" placeholder="Correo electronico" id="txtEmail" name="txtEmail">
                          <div class="form-control-feedback">
                            <i class="icon-droplets"></i>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">

                        <div class="form-group has-feedback has-feedback-left">
                          <input type="text" class="form-control input-lg" placeholder="Cuenta" id="txtUsuario" name="txtUsuario">
                          <div class="form-control-feedback">
                            <i class="icon-make-group"></i>
                          </div>
                        </div>
                        <div class="form-group has-feedback has-feedback-left">
                          <input type="text" class="form-control input-lg" placeholder="Contraseña" id="txtPassword" name="txtPassword">
                          <div class="form-control-feedback">
                            <i class="icon-make-group"></i>
                          </div>
                        </div>


                        <div class="form-group has-feedback has-feedback-left">
                          <select class="bootstrap-select" data-width="100%" id="cbxTipo" name="cbxTipo">
                            <option value="" disabled selected>---- Seleccionar Tipo Usuario --</option>
                            <option value="adm">-----Administrador</option>
                            <option value="ven">-----Vendedor</option>


                          </select>
                          <div class="form-control-feedback">
                            <i class="icon-droplets"></i>
                          </div>
                        </div>


                      </div>
                    </div>

                  </div>
                </div>
          </div>

          </fieldset>

          <div class="text-right">
            <a class="btn btn-primary" id="btnCancelarE" href="<?php echo base_url(); ?>empleado" type="submit" name="action"><i class="fa fa-arrow-circle-left"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-primary" id="btnGuardar" name="btnGuardar">Guardar <i class="icon-arrow-right14 position-right"></i></button>

            </form>
          </div>
        </div>
        <!-- /form horizontal -->

      </div>


    </div>
    <!-- /tabs content -->

  </div>


</div>
<!-- /content -->



<!-- <?php
      //}else{
      //  redirect('login','refresh');
      //}
      ?> -->