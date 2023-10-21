<!-- <?php
      //if ($this->session->userdata('usuario')) {
      ?> -->

<!---script de confirmacion para delete-->
<script type="text/javascript">
  function deleteConfirm(id) {
    if (confirm('¿Esta realmente segur@ de Eliminar?')) {
      window.location.href = "venta/delete" + "/" + id;

    }
  }
</script>

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
    display: block;
    width: 70%;
    margin: auto;
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

    <!-- Tabs -->
    <ul class="nav nav-lg nav-tabs nav-left no-margin no-border-radius   border-top border-top-indigo-100">
      <li class="active">
        <a href="#messages-tue" class="text-size-small text-uppercase bg-gray-100" data-toggle="tab">
          lista
        </a>
      </li>

      <li>

        <!-- <button type="button" class="btn bg-gray-100 text-uppercase text-black" data-toggle="modal" data-target="#exampleModal">
                    Agregar Venta
                </button> -->
        <a href="#messages-mon" class="text-size-small text-uppercase bg-gray-100" data-toggle="tab">
          agregar
        </a>
      </li>

    </ul>
    <!-- /tabs -->
    <!-- Tabs content -->
    <div class="tab-content">
      <div class="tab-pane  active" id="messages-tue">
        <!-- Basic datatable -->
        <div class="panel panel-flat">

          <table class="table datatable-basic">
            <thead>
              <tr>
                <th>Nº</th>
                <th>Cod.</th>
                <th>Nombre Cliente</th>
                <th>Empleado</th>
                <th>Total</th>
                <th>Fecha de Venta</th>
                <th>Descripcion</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $indice = 1;
              foreach ($listaVentas->result() as $row) {
              ?>
                <tr>
                  <td><?php echo $indice; ?></td>
                  <td><?php echo $row->idV; ?></td>
                  <td><?php echo $row->cNombre . ' ' . $row->cPA . ' ' . $row->cSA; ?></td>
                  <td><?php echo $row->eNombre . ' ' . $row->ePA . ' ' . $row->eSA; ?></td>
                  <td><?php echo $row->precioUnitario; ?></td>
                  <td><?php echo formatearFecha($row->fr); ?></td>
                  <td><?php echo character_limiter($row->descripcion,14); ?></td>

                  <td class="text-center">
                    <ul class="icons-list">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="icon-menu9"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                          <li><a href="<?php echo base_url('venta/edit') . "/" . $row->idV; ?>"><i class="icon-pencil5"></i> Modificar</a></li>
                          <li><a href="#" onclick="deleteConfirm(<?php echo $row->idV; ?>)"><i class="icon-bin"></i> Eliminar</a></li>
                          <li><a href="<?php echo base_url('venta/rc').'/'.$row->idV?>" target="_blank" ><i class="icon-file-pdf"></i> Recibo</a></li>
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
        <!-- /basic datatable -->
      </div>

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
            <form class="" style="margin-left: 10px; margin-right: 30px;" id="formDatos">
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
                    <input type="text" class="form-control input-lg  " placeholder="Total" id="tVentas" name="txtFoto" value="0" disabled>
                    <div class="form-control-feedback">

                    </div>
                  </div>
                </div>

              </div>
              <div class="form-group" style="padding-left:1px;">
                <label for="descripcion">Descripcion de Venta</label>
                <textarea name="descripcion" class="form-control input-lg  " id="" cols="30" rows="3">Ninguno</textarea>
              </div>

              <input type="hidden" id="inputCliente" name="inputCliente" value="0">


            </form>
          </div>


          <div class="venta-cobro__contenedor">

            <div class="venta-cobro">
              <div class="venta-cobro__header">
                <p class="venta-cobro__total f-w-b">Total Venta Bs.- 0</p>
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
                  <input type="number" placeholder="Escribe la cantidad" class="venta-cobro__input cantidad-dinero-recibido">
                </div>
                <div class="cont">

                  <p class="venta-cobro__total-venta f-w-b  m-b-0">Total Recibido: Bs.- <span class="tRecibido-span" style="display: block;">0</span></p>
                  <p class="venta-cobro__total-venta f-w-b  m-b-0">Total Venta: Bs.- <span class="enta-cobro__total-venta-span" style="display: block;">0</span></p>
                  <p class="venta-cobro__total-venta f-w-b  m-b-0">Total Cambio: Bs.- <span class="tCambio-span" style="display: block;">0</span></p>
                </div>
                <a target="_blank" class="btn btn-primary venta-cobro__boton" id="btnGuardar" name="btnGuardar">Generar Venta <i class="icon-arrow-right14 position-right"></i></a>
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




























<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:95% !important;height:80% !important; ">
    <div class="modal-content" style="height:95% !important; ">
      <div class="modal-header " style="background-color: #263238;height:90px">
        <h2 class="modal-title text-center text-white " id="exampleModalLabel" style="font-size:50px !important">Generar Venta</h2>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span class="text-white" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height:100% !important;height:80% !important;">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-5 " style="margin-top:50px !important">
              <div class="form-group has-feedback has-feedback-left ">
                <input type="text" class="form-control input-lg" placeholder="Cliente" id="cliente" name="txtFoto" onkeyup="btn_buscar_cliente();">
                <div class="form-control-feedback">
                  <i class="icon-make-group"></i>
                </div>
              </div>
              <div id="seleccionarCliente" style="padding:10px;text-align:right;position:absolute;background-color:white;z-index:9;top:40px"></div>
              <div class="container-busqueda"></div>
              <div class="form-group has-feedback has-feedback-left ">
                <input type="text" class="form-control input-lg" placeholder="Producto" id="producto" name="txtFoto" onkeyup="btn_buscar_producto();">
                <div class="form-control-feedback">
                  <i class="icon-make-group"></i>
                </div>
              </div>
              <div id="seleccionarProducto" style="padding:10px;text-align:right;position:absolute;background-color:white;z-index:9;top:100px"></div>

              <div class="form-group has-feedback has-feedback-left col-md-3">
                <p id='txtCantidadProducto' style="margin-bottom:0px">Cantidad</p>
                <input type="text" class="form-control input-lg" placeholder="Cantidad" id="cantidad" name="txtFoto" onkeyup="btn_calcular_total();">
                <div class="form-control-feedback">

                </div>
              </div>
              <div class="form-group has-feedback has-feedback-left col-md-3">
                Precio Venta
                <input type="text" class="form-control input-lg" placeholder="Precio" id="precio" name="txtFoto" onkeyup="btn_calcular_total();">
                <div class="form-control-feedback">

                </div>
              </div>
              <div class="form-group has-feedback has-feedback-left col-md-3">
                Precio Establecido
                <input type="text" class="form-control input-lg" placeholder="Precio" id="precioNormal" name="txtFoto" disabled>
                <div class="form-control-feedback">

                </div>
              </div>
              <div class="form-group has-feedback has-feedback-left col-md-3">
                Total
                <input type="text" class="form-control input-lg  " placeholder="Total" id="total" name="txtFoto" disabled>
                <div class="form-control-feedback">

                </div>
              </div>
              <input type="hidden" id="idProducto">
              <div class="col-md-12 mx-auto text-center">
                <button type="button" onclick="agregarProducto();" style="margin-top:15px; width:150px; height:50px" class="btn btn-success mx-auto">Agregar</button>
              </div>
            </div>

            <div class="col-md-6 " style="margin-left:120px !important">
              <h2 class="text-center ">Lista De Productos</h2>
              <div id="" style="height:300px;overflow-y:scroll">

                <table class="table " id="listaCarrito">
                  <thead>
                    <tr>
                      <th>Nº</th>
                      <th>Producto</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Total</th>

                      <th class="text-center">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>




                  </tbody>
                </table>
              </div>
              <!-- <input type="text" style="margin-top:10px;"> -->
              <div class="form-group has-feedback has-feedback-left col-md-3">
                Total Ventas
                <input type="text" class="form-control input-lg  " placeholder="Total" id="tVenta" name="txtFoto" disabled>
                <div class="form-control-feedback">

                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="modal-footer bg-secondary text-center p-1" style="background-color: #004038 ; height:90px">
        <button type="button" class="btn btn-danger mt-auto" style="margin-top:15px; width:150px; height:50px" data-dismiss="modal">Cancelar Venta</button>
        <button class="btn btn-success" onclick="envioCarrito()" style="margin-top:15px; width:150px; height:50px">Generar Venta</button>
      </div>
    </div>
  </div>
</div>

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

            <?php foreach ($listaProductos->result() as $row) : ?>

              <div class="col-6 col-sm-4 col-md-3 product  id-<?php echo $row->idCategoria ?>" style="margin-top:50px !important">

                <div class="card border border-primary idProducto-<?php echo $row->idProducto ?>" style="width: 210px; margin:auto; border: 0.8px solid lightblue;">
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
                    <a href="#" onclick="agregarProduct(<?php echo $row->idProducto ?>, '<?php echo $row->codigo ?>','<?php echo 'NOMBRE: ' . strtoupper($row->nombreProducto) . ' --  TALLA: ' . $row->talla . ' -- CATEGORIA: ' . $row->nombreCategoria . ' -- MARCA: ' . $row->nombreMarca . ' -- COLOR: ' . $row->color . ' -- MATERIAL: ' . $row->material ?>', <?php echo $row->precioNormal ?>, <?php echo $row->stock ?>)" class="btn btn-primary btnAgregarProd primero" style="width: 100%;">Agregar</a>

                    <!-- Boton desagregar -->
                    <a href="#" onclick="desagregarProductoEnTablaDesdeModal(<?php echo $row->idProducto ?>)" class="btn btn-danger btnAgregarProd ultimo" style="width: 100%;display:none">Desagregar</a>

                  </div>
                </div>
              </div>

            <?php endforeach; ?>








          </div>

        </div>
      </div>
      <div class="modal-footer bg-secondary text-center p-1" style="background-color: #004038 ; height:90px">
        <button type="button" class="btn btn-danger mt-auto" style="margin-top:15px; width:150px; height:50px" data-dismiss="modal">Cancelar Venta</button>
        <button class="btn btn-success" onclick="envioCarrito()" style="margin-top:15px; width:150px; height:50px">Generar Venta</button>
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