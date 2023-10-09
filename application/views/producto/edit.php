<?php
//var_dump($getEstudiante);
//print_r($getProducto->result())

?>


<div class="tab-pane" id="messages-mon">
  <!-- Form horizontal -->
  <div class="panel panel-flat">

    <div class="panel-body">
      <h2>Modificar Producto</h2>
      <form class="form-horizontal" action="<?php echo base_url('producto/update') ?>" method="POST" id="formEdit" enctype="multipart/form-data">

        <fieldset class="content-group">
          <?php foreach ($getProducto->result() as $row) { ?>
            <input type="hidden" name="txtIdProducto" value="<?php echo $row->idProducto; ?>">
            <div class="form-group">
              <div class="col-lg-10">
                <div class="row">
                  <div class="col-md-6">

                    <div class="form-group has-feedback has-feedback-left">
                      <input type="text" class="form-control input-xlg" id="txtCodigo" name="txtCodigo" value="<?php echo $row->codigo; ?>">
                      <div class="form-control-feedback">
                        <i class="icon-office"></i>
                      </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                      <input type="text" class="form-control input-lg" id="txtNombreProducto" name="txtNombreProducto" value="<?php echo $row->nombreProducto; ?>">
                      <div class="form-control-feedback">
                        <i class="icon-make-group"></i>
                      </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                      <input type="number" class="form-control" id="txtPrecioNormal" name="txtPrecioNormal" value="<?php echo $row->precioNormal; ?>">
                      <div class="form-control-feedback">
                        <i class="icon-droplets"></i>
                      </div>
                    </div>

                    <div class="form-group has-feedback has-feedback-left">
                      <input type="text" class="form-control input-xs" id="txtStock" name="txtStock" value="<?php echo $row->stock; ?>">
                      <div class="form-control-feedback">
                        <i class="icon-help"></i>
                      </div>
                    </div>
                    <div class="form-group has-feedback has-feedback-left ocultarAlCambiar">
                      <div>
                        <?php echo fotoProducto($row->foto, "120"); ?>
                      </div>

                      <a class="btn btn-primary px-3 " id="btnCambiarImg" href="#">Cambiar Imagen</a>

                    </div>
                    <div class="form-group has-feedback has-feedback-left mostrarAlCancelar" style="display:none;">
                      
                      <div class="form-control-feedback">
                        <i class="icon-help"></i>
                      </div>
                      <a class="btn btn-primary px-3 " id="btnCancelarImg" href="#">Cancelar Cambio de Imagen</a>
                    </div>
                  </div>
                  <input type="hidden" name="verificador" value="sin" id="verificacion">

                  <div class="col-md-6">

                    <!-- Default select -->

                    <div class="form-group">
                      <label>Categoria</label>
                      <?php
                      $listaCategoria = array();
                      foreach ($categorias->result() as $row1) {
                        $listaCategoria[$row1->idCategoria] = $row1->nombreCategoria;
                      }
                      echo form_dropdown('cbxCategoria', $listaCategoria, $row->idCategoria, 'class="form-control"');
                      ?>

                    </div>
                    <!-- /default select -->


                    <!-- Default select -->

                    <div class="form-group">
                      <label>Marca</label>
                      <?php
                      $listaMarca = array();
                      foreach ($marcas->result() as $row1) {
                        $listaMarca[$row1->idMarca] = $row1->nombreMarca;
                      }
                      echo form_dropdown('cbxMarca', $listaMarca, $row->idMarca, 'class="form-control"');
                      ?>
                    </div>
                    <!-- /default select -->

                    <!-- Default select -->

                    <div class="form-group">
                      <label>Color</label>
                      <?php
                      $listaColor = array();
                      foreach ($color->result() as $row1) {
                        $listaColor[$row1->idColor] = $row1->color;
                      }
                      echo form_dropdown('cbxColor', $listaColor, $row->idColor, 'class="form-control"');
                      ?>
                    </div>
                    <!-- /default select -->

                    <div class="form-group">
                      <label>Material</label>
                      <?php
                      $listaMaterial = array();
                      foreach ($materiales->result() as $row1) {
                        $listaMaterial[$row1->idTipoMaterial] = $row1->material;
                      }
                      echo form_dropdown('cbxMaterial', $listaMaterial, $row->idMaterial, 'class="form-control"');
                      ?>
                    </div>
                    <!-- /default select -->


                    <div class="form-group">
                      <label>Talla</label>
                      <?php
                      $listaTalla = array();
                      foreach ($tallas->result() as $row1) {
                        $listaTalla[$row1->idTalla] = $row1->talla;
                      }
                      echo form_dropdown('cbxTalla', $listaTalla, $row->idTalla, 'class="form-control"');
                      ?>
                    </div>
                    <!-- /default select -->

                    <div class="form-group has-feedback">
                      <input type="text" class="form-control input-xs" id="txtDescripcion" name="txtDescripcion" value="<?php echo $row->descripcion; ?>">
                      <div class="form-control-feedback">
                        <i class="icon-help"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </fieldset>

        <div class="text-right">
          <button type="submit" class="btn btn-primary" id="btnGuardar" name="btnGuardar">Guardar <i class="icon-arrow-right14 position-right"></i></button>

      </form>
    </div>
  </div>
  <!-- /form horizontal -->

</div>