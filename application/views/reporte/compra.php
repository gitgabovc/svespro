<?php


?>


<div class="tab-pane" id="messages-mon">
    <!-- Form horizontal -->
    <div class="panel panel-flat">

        <div class="panel-body">

            <div class="form-horizontal" >

                <fieldset class="content-group">

                    <div class="form-group">
                        <div class="col-lg-10">

                            <h3>Reporte Compras Por Fechas</h3>
                            
                            <div class="row">
                                <div class="col-md-4">

                                    <label>Fecha de Inicio</label>
                                    <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" value="<?php echo date("Y-m-d"); ?>">

                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-4">

                                    <label>Fecha Final</label>
                                    <input type="date" name="fechaFinal" id="fechaFinal" class="form-control" value="<?php echo date("Y-m-d"); ?>">

                                </div>

                            </div>
                            <p class="text-danger" style="display:none;" id="fechaIncorrecta">La fecha final debe ser mayor a la fecha de inicio</p>
                            <p class="text-danger" id="fechaVacia" style="display:none;">Se debe ingresar las fechas de inicio y final</p>
                            
                        </div>
                    </div>
                </fieldset>

                <div class="text-left">
                    <button class="btn btn-success" id="btnFechas" name="btnGuardar">Generar Reporte Por Fechas Ingresadas <i class="icon-arrow-right14 position-right"></i></button>
                </div>
                <div class="text-left" style="margin-top:10px;">
                    <button class="btn btn-success" id="btnSinFechas" name="btnGuardar">Mostrar Todas Las Compras <i class="icon-arrow-right14 position-right"></i></button>
                </div>

            
        </div>
    </div>
    <!-- /form horizontal -->

</div>

    