<?php 

//print_r($listaPagos);
//var_dump($listaPagos);

foreach($listaPagos->result() as $row) 
    { 
            
    $cliente=$row->cliente;
    $fechaHora=$row->fecha;
    $saldoAnterior=$row->saldoAnterior;   
    $aCuenta=$row->aCuenta;
    $saldoActual=$row->saldoActual;     
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
                        <h6>Datos del cliente</h6>

                        <div class="row">
                            <div class="col s12 m6 l3">
                                    <div class="input-field">
                                    <input type="text" value="<?php echo $cliente; ?>" >
                                    <label for="l-name">Nombre</label>
                                </div>                     
                            </div>

                            <div class="form-action">
                                    <a class="btn waves-effect waves-light grey darken-4" id="btnCancelar" href="<?php echo base_url('creditos'); ?>"><i class="fa fa-arrow-circle-left"></i> Volver</a>
                            </div>

                        </div>
                        
                                    
                        
                        <h6>Historial de pagos</h6>
                        <div class="divider"></div>

                        <div class="row">
                            
                            
                            <div id="test2" class="col s12">
                    <!-- inicio lista --> 
                    <table id="detalles" class="table table-striped table-bordered table-condensed table-hover"  >
                    <thead style="background-color:#A9D0F5">
                        <th>Nro.</th>
                        <th>Saldo Anterior</th>
                        <th>a Cuenta</th>
                        <th>Saldo Actual</th>
                        <th>Fecha</th>
                                                    
                    </thead>

                   
                                <tbody>
                                    <?php
                                          $indice=1;    
                                    foreach($listaPagos->result() as $row) 
                                    { ?>

                                    <tr>
                                        <td><?php echo $indice; ?></td>
                                        <td><?php echo $row->saldoAnterior; ?></td>
                                        <td><?php echo $row->aCuenta; ?></td>
                                        <td><?php echo $row->saldoActual; ?></td>
                                        <td><?php echo $row->fecha; ?></td>
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
                                        <a class="btn waves-effect waves-light grey darken-4" id="btnCancelar" href="<?php echo base_url('creditos'); ?>"><i class="fa fa-arrow-circle-left"></i> Volver</a>
                                    </div>
                                </div>

                           

                        </div>
                                
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>