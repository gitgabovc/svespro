<?php 

//print_r($detalleVentas);
//var_dump($detalleVentas);

foreach($detalleCompras->result() as $row) 
    { 
            
    $fechaHora=$row->fecha;
    $totalCompra=$row->totalCompra;   
    $idCompra=$row->idCompra;
    $usuario=$row->usuario;     
    }

?>
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
                        <h6>Datos de la Compra</h6>

                        <div class="row">
                            

                            <div class="col s12 m6 l2">
                                    <div class="input-field">
                                    <input type="text" value="<?php echo $usuario; ?>" >
                                    <label for="l-name">Usuario</label>
                                </div>                     
                            </div>

                            <div class="col s12 m6 l2">
                                    <div class="input-field">
                                    <input type="text" class="form-control" name="txtFechaInstalacion" step="1" min="2019-01-01" value="<?php echo $fechaHora; ?>">
                                    <label for="l-name">Fecha</label>
                                </div>                     
                            </div>

                        </div>
                        <h6>Detalle compra</h6>
                        <div class="divider"></div>

                        <div class="row">
                            
                            
                            <div id="test2" class="col s12">
                    <!-- inicio lista --> 
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover"  >
                    <thead style="background-color:#A9D0F5">
                        <th>Nro.</th>
                        <th>Articulo</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                                                    
                        </thead>

                        <tfoot style="background-color:#A9D0F5">
                            <th></th>
                            <th></th>
                            <th></th>                       
                            <th>TOTAL</th>
                            <th><h4 id="total">BS/. <?php echo $totalCompra; ?></h4></th>
                            
                            </tfoot>
                                <tbody>
                                    <?php
                                          $indice=1;    
                                    foreach($detalleCompras->result() as $row) 
                                    { ?>

                                    <tr>
                                        <td><?php echo $indice; ?></td>
                                        <td><?php echo $row->nombreArticulo; ?></td>
                                        <td><?php echo $row->cantidad; ?></td>
                                        <td><?php echo $row->precioCompra; ?></td>
                                        <td><?php echo ($row->cantidad)*($row->precioCompra); ?></td>
                                    </tr>

                                    <?php 
                                    $indice++;
                                    }
                                    ?> 
                                                         
                                </tbody>
                    </table>
                                
                    <!-- final lista -->
                            </div>

                        </div>

                        <div class="row">

                            <div class="divider"></div>
                                <div class="card-content">
                                    <div class="form-action">
                                        <a class="btn waves-effect waves-light cyan" id="btnImprimir" href="<?php echo base_url('compras/recibopdf')."/".$idCompra; ?>"><i class="large material-icons">print</i> Imprimir</a>
                                        <a class="btn waves-effect waves-light grey darken-4" id="btnCancelar" href="<?php echo base_url('compras'); ?>"><i class="fa fa-arrow-circle-left"></i> Volver</a>
                                    </div>
                                </div>

                           

                        </div>
                                
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>