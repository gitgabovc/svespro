<!-- <?php
      //if ($this->session->userdata('usuario')) {
      ?> -->



<style>
  .ventas__contenedor {
    display: block;
  }

  @media (min-width:1280px) {
    .ventas__contenedor {
      display: flex;
    }
  }


  .venta-cobro__contenedor {
    width: 100%;
    margin: 0 auto;
    margin-bottom: 30px;
  }


  .venta-cobro {
    border: 1px solid silver;
    border-radius: 10px;
    overflow: hidden;
    width: 90%;
    margin: 0 auto;
  }



  @media (min-width:1280px) {
    .venta-cobro__contenedor {
      width: 30%;
      margin: 0 auto;
      margin-top: 30px;
    }


    .venta-cobro {
      border: 1px solid silver;
      border-radius: 10px;
      overflow: hidden;
      width: 100%;
    }


  }

  .venta-cobro__header {
    padding: 8px;
    background-color: blue;
    color: white;
    font-weight: bold;
    font-size: 16px;
    text-align: center;
  }

  .venta-cobro__body {
    padding: 25px 30px 25px 30px;
  }

  .venta-cobro__input {
    display: block;
    width: 100%;
    border-radius: 8px;
    padding: 8px;
    border: .8px solid silver;

  }

  .venta-cobro__boton {
  }


  #carritoB {
    overflow-x: scroll;
  }

  @media (min-width:1000px) {
    #carritoB {
      overflow-x: hidden;
    }
  }

  .cont {
    margin-bottom: 13px;
  }

  .f-w-b {
    font-weight: bold;
    font-size: 20px;
  }

  .m-b-0 {
    margin-bottom: 0;
  }

  .seleccionado {
    outline: 9px solid blue;
  }
</style>

<?php
//print_r($usuario->result());

?>
<!-- content-->
<div class="row">

  <div class="col-lg-12">


    <!-- /tabs -->
    <!-- Tabs content -->
    <div class="">


      <div class="tab-pane " id="messages-mon">
        <!-- Form horizontal -->
        <div class="panel panel-flat ventas__contenedor">
          <div class="panel-body">
            <fieldset class="content-group">
              <div class="form-group">
                <div class="col-lg-10">
                  <div class="row">


                    <div class="col-md-12 mb-5">
                      <div class="row mb-5 " style="display: flex; align-items:end;">
                        <div class="col-md-8">
                          <div class="form-group">
                            <label>Producto</label>
                            <select data-placeholder="Seleccionar Producto" class="select-size-lg" id="txtProducto">
                              <option></option>
                              <?php
                              foreach ($listaProductos->result() as $row) :
                              ?>
                                <option id="p-<?php echo  $row->idProducto ?>" value="<?php echo  $row->idProducto ?>"><?php echo "NOMBRE: " . strtoupper($row->nombreProducto) . " -- <b> TALLA: </b>" . $row->talla . " -- CATEGORIA: " . $row->nombreCategoria . " -- MARCA: " . $row->nombreMarca . " -- COLOR: " . $row->color . " -- MATERIAL: " . $row->material ?></option>
                              <?php
                              endforeach;
                              ?>

                            </select>
                          </div>
                        </div>
                        <div class="col-md-2 mt-5 align-self-end">
                          <a class="btn btn-primary mt-5" data-toggle="modal" data-target="#exampleModalProductos">Ver Productos</a>

                        </div>
                      </div>
                    </div>


                    <div class="row mb-5 mt-5">

                      <div class="col-md-2">
                        <a href="#" id="btnAddProducto" class="btn btn-success" style="margin-left: 10px;">+ Agregar Producto</a>
                        <p style="display: none; color: red;" id="duplicado">Este producto ya esta agregado</p>
                      </div>
                    </div>





                  </div>

                </div>
              </div>
            </fieldset>
            <form class="" style="margin-left: 10px; margin-right: 30px;" id="formDatos"  action="<?php echo base_url('venta/updateInDataBase') ?>" method="POST">
              <h2 class="">Lista De Productos</h2>
              <div id="carritoB" style="margin-bottom:50px;">

                <table class="table table-bordered" id="listaCarrito">
                  <thead>
                    <tr>
                      <th>Nº</th>
                      <th>Código</th>
                      <th>Producto</th>
                      <th>Stock</th>
                      <th>Cantidad</th>
                      <th>Precio Venta</th>
                      <th>Total</th>

                      <th class="text-center">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <td id="sin-productos" colspan="8" class="text-center">Sin Productos Agregados</td>



                  </tbody>
                </table>
              </div>
              <!-- <input type="text" style="margin-top:10px;"> -->
              <div class="row" style="display:flex; justify-content: start; padding-left:7px;">

                <div class="col-4">
                  <div class="form-group has-feedback has-feedback-left ">
                    Total Venta
                    <input type="text" class="form-control input-lg  " placeholder="Total" id="tVentas" name="txtFoto" value="<?php echo $getVenta->row()->precioUnitario ?>" disabled>
                    <div class="form-control-feedback">

                    </div>
                  </div>
                </div>

              </div>
              <div class="form-group" style="padding-left:1px;">
                <label for="descripcion">Descripcion de Venta</label>
                <textarea name="descripcion" class="form-control input-lg  " id="" cols="30" rows="3"><?php echo $getVenta->row()->descripcion ?></textarea>
              </div>

              <input type="hidden" id="inputCliente" name="inputCliente" value="<?php echo $getVenta->row()->idCliente ?>">
              <input type="hidden" id="idVenta" name="idVenta" value="<?php echo $getVenta->row()->idVenta ?>">

              <?php foreach ($getDetalleVenta->result() as $row):?>

                <input type="hidden"  name="idProductoAnterior[]" value="<?php echo $row->idProducto ?>">

                <input type="hidden"  name="cantidadAnterior[]" value="<?php echo $row->cantidad ?>">
              
              <?php endforeach?>

              <div class="text-right">

                <a href="<?php echo base_url("venta");?>" class="btn btn-danger venta-cobro__boton" >Cancelar Edición <i class="position-right"></i></a>
                <button type="submit" class="btn btn-primary venta-cobro__boton" name="btnGuardar">Editar Venta <i class="icon-arrow-right14 position-right"></i></button>
                
              </div>


            </form>
          </div>


          <div class="venta-cobro__contenedor">

            <div class="venta-cobro">
              <div class="venta-cobro__header">
                <p class="venta-cobro__total f-w-b">Total Venta Bs.- <?php echo $getVenta->row()->precioUnitario ?></p>
              </div>
              <div class="venta-cobro__body">
                <div class="cont">
                  <p class="venta-cobro__vendedor f-w-b m-b-0">Vendedor:</p>
                  <p class="venta-cobro__vendedor-nombre m-b-0"><?php echo strtoupper($this->session->userdata('nombreCompleto')) ?></p>
                </div>
                <div class="cont">
                  <p class="venta-cobro__cliente f-w-b m-b-0">Cliente:</p>
                  <!-- <input type="number" placeholder="Seleccionar Cliente" class="venta-cobro__input"> -->
                  <select data-placeholder="Seleccionar Cliente" class="select-size-lg venta-cobro__input" id="txtCliente">
                    <option></option>

                    <?php
                    foreach ($listaClientes->result() as $row) :
                    ?>
                      <option value="<?php echo $row->idCliente ?>"><?php echo strtoupper($row->nombres . " " . $row->primerApellido . " " . $row->segundoApellido) ?></option>
                    <?php
                    endforeach;
                    ?>

                  </select>
                </div>
                <div class="cont">

                  <p class="venta-cobro__cliente-nombre f-w-b  m-b-0">Efectivo Recibido:</p>
                  <input type="number" placeholder="Escribe la cantidad" class="venta-cobro__input cantidad-dinero-recibido form-control " value="<?php echo round($getVenta->row()->precioUnitario)?>" disabled>
                </div>
                <div class="cont">

                  <p class="venta-faltante-sobrante f-w-b  m-b-0"></p>
                  <input type="number" placeholder="Escribe la cantidad" class="form-control "  id="venta-faltante-sobrante-input">
                  <p class="venta-cobro__total-venta f-w-b  m-b-0">Total Recibido: Bs.- <span class="tRecibido-span">0</span></p>
                  <p class="venta-cobro__total-venta f-w-b  m-b-0">Total Venta: Bs.- <span class="enta-cobro__total-venta-span">0</span></p>
                  <p class="venta-cobro__total-venta f-w-b  m-b-0">Total Cambio: Bs.- <span class="tCambio-span">0</span></p>
                </div>
               
              </div>
            </div>

            <!-- <a class="btn btn-primary" id="btnCancelarE" href="<?php // echo base_url(); 
                                                                    ?>cliente" type="submit" name="action"><i class="fa fa-arrow-circle-left"></i> Cancelar
            </a> -->


          </div>
        </div>
        <!-- /form horizontal -->

      </div>



    </div>
    <!-- /tabs content -->

  </div>


</div>
<!-- /content -->
<!-- Button trigger modal -->






























<div class="modal fade" id="exampleModalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:95% !important; ">
    <div class="modal-content" style=" ">
      <div class="modal-header " style="background-color: #263238;height:90px">
        <h2 class="modal-title text-center text-white " id="exampleModalLabel" style="font-size:50px !important">Seleccione los Productos</h2>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span class="text-white" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="">
        <div class="container-fluid">
          <div class="row " style="text-align: center;">
            <?php foreach ($listaCategoria->result() as $row) : ?>
              <a href="#" style="font-size:19px;" id="id-<?php echo $row->idCategoria ?>" class="badge badge-pill badge-primary categoria"><?php echo $row->nombreCategoria ?></a>
            <?php endforeach; ?>
            <a href="#" style="font-size:19px;" id="id-<?php echo "0" ?>" class="badge badge-pill badge-success categoria">Todos</a>
          </div>
          <div class="row imgProductosP">

            <?php
            $idProductosSeleccionados = array();
            foreach ($getDetalleVenta->result() as $row) {
              array_push($idProductosSeleccionados, $row->idProducto);
            } ?>

            <?php foreach ($listaProductos->result() as $row) : ?>

              <div class="col-6 col-sm-4 col-md-3 product  id-<?php echo $row->idCategoria ?> " style="margin-top:50px !important">

                <div class="card border border-primary idProducto-<?php echo $row->idProducto ?> <?php echo (in_array($row->idProducto, $idProductosSeleccionados)) ? "seleccionado" : "" ?>" style="width: 210px; margin:auto; border: 0.8px solid lightblue;">
                  <input type="hidden" value="<?php echo $row->idProducto ?>">
                  <?php echo imgProducto($row->foto, $row->nombreProducto) ?>
                  <div class="card-body" style="padding:8px;">
                    <h5 class="card-title"><?php echo strtoupper($row->nombreProducto) ?></h5>

                    <p class="card-text"><span style="font-weight: bold; ">Precio: </span><?php echo $row->precioNormal ?></p>
                    <p class="card-text"><span style="font-weight: bold; ">Inventario: </span><?php echo $row->stock ?></p>
                    <p class="card-text"><span style="font-weight: bold; ">Categoria: </span><?php echo $row->nombreCategoria ?></p>
                    <p class="card-text"><span style="font-weight: bold; ">Material: </span><?php echo $row->material ?></p>
                    <p class="card-text"><span style="font-weight: bold; ">Color: </span><?php echo $row->color ?></p>
                    <p class="card-text"><span style="font-weight: bold; ">Talla: </span><?php echo $row->talla ?></p>

                    <!-- Boton agregar -->
                    <a href="#" onclick="agregarProduct(<?php echo $row->idProducto ?>, '<?php echo $row->codigo ?>','<?php echo 'NOMBRE: ' . strtoupper($row->nombreProducto) . ' --  TALLA: ' . $row->talla . ' -- CATEGORIA: ' . $row->nombreCategoria . ' -- MARCA: ' . $row->nombreMarca . ' -- COLOR: ' . $row->color . ' -- MATERIAL: ' . $row->material ?>', <?php echo $row->precioNormal ?>, <?php echo $row->stock ?>)" class="btn btn-primary btnAgregarProd primero" style="width: 100%; <?php echo (in_array($row->idProducto, $idProductosSeleccionados)) ? "display:none" : "" ?> ">Agregar</a>

                    <!-- Boton desagregar -->
                    <a href="#" onclick="desagregarProductoEnTablaDesdeModal(<?php echo $row->idProducto ?>)" class="btn btn-danger btnAgregarProd ultimo" style="width: 100%; <?php echo (in_array($row->idProducto, $idProductosSeleccionados)) ? "display:block" : "display:none" ?>">Desagregar</a>

                  </div>
                </div>
              </div>

            <?php endforeach; ?>








          </div>

        </div>
      </div>
      <div class="modal-footer bg-secondary text-center p-1" style="background-color: #004038 ; height:90px">
        <button type="button" class="btn btn-danger mt-auto" style="margin-top:15px; width:150px; height:50px" data-dismiss="modal">Cerrar</button>
       
      </div>
    </div>
  </div>
</div>



<!-- <?php
      //}else{
      //  redirect('login','refresh');
      //}
      ?> -->


<!-- <tr>
                                            <td>dwa</td>
                                            <td>dwa</td>
                                            <td>dwa</td>
                                            <td>wda</td>

                                            <td class="text-center">
                                                <a class="text-white" style="background-color: #004038 ;border-radius: 50%;padding: 5px 10px;text-decoration: none;color: white;font-weight: bold;" href="#">X</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>dwa</td>
                                            <td>dwa</td>
                                            <td>dwa</td>
                                            <td>wda</td>

                                            <td class="text-center">
                                                <a class="text-white" style="background-color: #004038 ;border-radius: 50%;padding: 5px 10px;text-decoration: none;color: white;font-weight: bold;" href="#">X</a>
                                            </td>
                                        </tr> -->





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