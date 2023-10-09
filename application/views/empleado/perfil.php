<!-- <?php
      //if ($this->session->userdata('usuario')) {
      ?> -->

<!---script de confirmacion para delete-->



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
          Perfil
        </a>
      </li>



    </ul>
    <!-- /tabs -->
    <!-- Tabs content -->
    <div class="tab-content">
      <div class="tab-pane active " id="messages-tue">
        <!-- Basic datatable -->
        <div class="panel panel-flat " style="padding: 20px;">
          <div class="row">
            <div class="col-6">
              <?php echo  fotoUsuario($usuario->row()->foto, "300") ?>
              <div class="" style="text-align: center; width:300px">
                <h2><?php echo strtoupper($usuario->row()->nombres . " " . $usuario->row()->primerApellido . " " . $usuario->row()->segundoApellido) ?></h2>
                <p><span style="font-weight:bold;">Email: </span> <?php echo  $usuario->row()->email ?></p>
                <p><span style="font-weight:bold;">Tipo de Usuario: </span> <?php echo  cambiarTipo($usuario->row()->tipo) ?></p>
                <p><span style="font-weight:bold;">Telefono: </span> <?php echo  $usuario->row()->telefono ?></p>
                <p><span style="font-weight:bold;">Usuario: </span> <?php echo  $usuario->row()->usuario ?></p>
                <p><span style="font-weight:bold;">Contraseña: </span> ********* </p>
              </div>
              <div class="" style="text-align: center; width:300px">
                <a href=" <?php echo  base_url() ?>empleado/configuracion" class="btn btn-primary">Editar Cuenta</a>
              </div>
            </div>

          </div>

        </div>
        <!-- /basic datatable -->
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