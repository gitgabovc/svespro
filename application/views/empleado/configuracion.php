<?php
//var_dump($getEstudiante);
//print_r($getProducto->result())

?>


<div class="tab-pane" id="messages-mon">
  <!-- Form horizontal -->
  <div class="panel panel-flat">

    <div class="panel-body">

      <form class="form-horizontal" action="<?php echo base_url('empleado/updateUsuario') ?>" method="POST" enctype="multipart/form-data">

        <fieldset class="content-group">

          <input type="hidden" name="txtIdEmpleado" value="<?php echo $usuario->row()->idEmpleado ?>">
          <div class="form-group">
            <div class="col-lg-10">
              <div class="row">
                <div class="col-md-6">

                  <div class="form-group has-feedback has-feedback-left ocultarAlCambiar">
                    <div>
                      <?php echo fotoUsuario($usuario->row()->foto, "120"); ?>
                    </div>

                    <a class="btn btn-primary px-3 " id="btnCambiarImg" href="#">Cambiar Imagen</a>

                  </div>
                  <div class="form-group has-feedback has-feedback-left mostrarAlCancelar" style="display:none;">

                    <div class="form-control-feedback">
                      <i class="icon-help"></i>
                    </div>
                    <a class="btn btn-primary px-3 " id="btnCancelarImg" href="#">Cancelar Cambio de Imagen</a>
                  </div>

                  <input type="hidden" name="verificador" value="sin" id="verificacion">



                  


                

                  <div class="form-group has-feedback has-feedback-left">
                    <label>Cuenta:</label>

                    <input type="text" class="form-control input-lg" placeholder="Cuenta" id="txtUsuario" name="txtUsuario" value="<?php echo  $usuario->row()->usuario ?>">
                    <div class="form-control-feedback">
                      <i class="icon-make-group"></i>
                    </div>
                  </div>
                  <div class="form-group has-feedback has-feedback-left">
                    <label>Contraseña:</label>
                    <input type="text" class="form-control input-lg" placeholder="Contraseña" id="txtPassword" name="txtPassword" value="<?php echo $usuario->row()->password ?>">
                    <div class="form-control-feedback">
                      <i class="icon-make-group"></i>
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