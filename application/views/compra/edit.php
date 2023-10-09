<?php
//var_dump($getEstudiante);
//print_r($getProducto->result())

?>


<div class="tab-pane" id="messages-mon">
  <!-- Form horizontal -->
  <div class="panel panel-flat">

    <div class="panel-body">



      <fieldset class="content-group">
        <div class="form-group">
          <div class="col-lg-10">
            <div class="row">
              <div class="col-md-12">
                <div class="row mb-5 " style="display: flex; align-items:end;">
                  <div class="col-md-8">
                    <div class="form-group">
                      <?php ?>
                      <label>Proveeedor</label>
                      <select data-placeholder="Seleccionar Proveedor" class="select-size-lg" id="txtProveedor">
                        <option></option>
                        <option selected disabled><?php
                                                  foreach ($getProveedor->result() as $row) :
                                                    if ($row->idProveedor == $getCompra->row()->idProveedor) {
                                                      echo strtoupper($row->nombreProveedor);
                                                    }
                                                  endforeach;


                                                  ?></option>


                        <?php

                        foreach ($getProveedor->result() as $row) :
                        ?>
                          <option value="<?php echo $row->idProveedor ?>"><?php echo strtoupper($row->nombreProveedor) ?><?php if ($row->idProveedor == $getCompra->row()->idProveedor) "selected"; ?></option>
                        <?php
                        endforeach;
                        ?>

                      </select>
                    </div>
                  </div>
                  <div class="col-md-2 mt-5 align-self-end">
                    <a href="#" class="btn btn-primary mt-5">+ Agregar Nuevo</a>
                  </div>
                </div>
              </div>

              <div class="col-md-12 mb-5">
                <div class="row mb-5 " style="display: flex; align-items:end;">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Producto</label>
                      <select data-placeholder="Seleccionar Producto" class="select-size-lg" id="txtProducto">
                        <option></option>


                        <?php
                        foreach ($getProducto->result() as $row) :
                        ?>
                          <option id="p-<?php echo  $row->idProducto ?>" value="<?php echo  $row->idProducto ?>"><?php echo "NOMBRE: " . strtoupper($row->nombreProducto) . " -- <b> TALLA: </b>" . $row->talla . " -- CATEGORIA: " . $row->nombreCategoria . " -- MARCA: " . $row->nombreMarca . " -- COLOR: " . $row->color . " -- MATERIAL: " . $row->material ?></option>
                        <?php
                        endforeach;
                        ?>

                      </select>
                    </div>
                  </div>
                  <div class="col-md-2 mt-5 align-self-end">
                    <a href="#" class="btn btn-primary mt-5">+ Agregar Nuevo</a>

                  </div>
                </div>
              </div>


              <div class="row mb-5 mt-5">

                <div class="col-md-2">
                  <a href="#" id="btnAddProducto" class="btn btn-success">+ Agregar Producto</a>
                  <p style="display: none; color: red;" id="duplicado">Este producto ya esta agregado</p>
                </div>
              </div>





            </div>

          </div>
        </div>
    </div>

    </fieldset>
    <form class="" action="<?php echo base_url('compra/update') ?>" method="POST" style="margin-left: 30px; margin-right: 30px;">
      <input type="hidden" name="idCompra" value="<?php echo  $getCompra->row()->idCompra ?>">
      <h2 class="">Lista De Productos</h2>
      <div id="carritoB" style="height:300px;overflow-y:scroll">

        <table class="table" id="listaCarrito">
          <thead>
            <tr>
              <th>Nº</th>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Precio Compra</th>
              <th>Precio Venta</th>
              <th>Compra</th>
              <th>Venta</th>
              <th>Utilidad</th>

              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>





            <!-- <tr>
                    <td>dwa</td>
                    <td>dwa</td>
                    <td>
                      <input type="number" class="form-control" placeholder="Text input">
                    </td>
                    <td>
                      <input type="number" class="form-control" placeholder="Text input">
                    </td>
                    <td>
                      <input type="number" class="form-control" placeholder="Text input">
                    </td>
                    <td>wda</td>
                    <td>wda</td>
                    <td>wda</td>

                    <td class="text-center">
                      <a class="text-white" style="background-color: #004038 ;border-radius: 50%;padding: 5px 10px;text-decoration: none;color: white;font-weight: bold;" href="#">X</a>
                    </td>
                  </tr>
                  <tr>
                    <td>dwa</td>
                    <td>dwa</td>
                    <td>
                      <input type="text" class="form-control" placeholder="Text input">
                    </td>
                    <td>
                      <input type="text" class="form-control" placeholder="Text input">
                    </td>
                    <td>
                      <input type="text" class="form-control" placeholder="Text input">
                    </td>
                    <td>wda</td>
                    <td>wda</td>
                    <td>wda</td>

                    <td class="text-center">
                      <a class="text-white" style="background-color: #004038 ;border-radius: 50%;padding: 5px 10px;text-decoration: none;color: white;font-weight: bold;" href="#">X</a>
                    </td>
                  </tr> -->


          </tbody>
        </table>
      </div>
      <!-- <input type="text" style="margin-top:10px;"> -->
      <div class="row" style="display:flex; justify-content: space-between;">
        <div class="col-4">
          <div class="form-group has-feedback has-feedback-left ">
            Total Compra
            <input type="text" class="form-control input-lg  " placeholder="Total" id="tCompras" name="tventas" disabled>
            <div class="form-control-feedback">

            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="form-group has-feedback has-feedback-left ">
            Total Venta
            <input type="text" class="form-control input-lg  " placeholder="Total" id="tVentas" name="txtFoto" disabled>
            <div class="form-control-feedback">

            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="form-group has-feedback has-feedback-left ">
            Total Utilidad
            <input type="text" class="form-control input-lg  " placeholder="Total" id="tUtilidad" name="txtFoto" disabled>
            <div class="form-control-feedback">

            </div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="descripcion">Descripcion de Compra</label>
        <textarea name="descripcion" class="form-control input-lg  " id="" cols="30" rows="3"><?php echo $getCompra->row()->descripcion ?></textarea>
      </div>

      <input type="hidden" id="idProveedor" name="idProveedor" value="<?php echo $getCompra->row()->idProveedor ?>">

      <?php foreach ($getDetalleCompra->result() as $row):?>
        <input type="hidden"  value="<?php echo $row->idProducto ?>" name="idProductoAnterior[]">
        <input type="hidden" value="<?php echo $row->cantidad?>" name="cantidadAnterior[]">
      <?php endforeach;?>


      <div class="text-right">
        <a class="btn btn-primary" id="btnCancelarE" href="<?php echo base_url(); ?>cliente" type="submit" name="action"><i class="fa fa-arrow-circle-left"></i> Cancelar
        </a>
        <button type="submit" class="btn btn-primary" name="btnGuardar">Guardar <i class="icon-arrow-right14 position-right"></i></button>


      </div>
    </form>
  </div>
  <!-- /form horizontal -->

</div>