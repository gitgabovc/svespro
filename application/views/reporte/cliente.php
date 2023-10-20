<?php
//var_dump($getEstudiante);
//print_r($getCategoria->result())

?>


<div class="tab-pane" id="messages-mon">
    <!-- Form horizontal -->
    <div class="panel panel-flat">

        <div class="panel-body">

            <div class="form-horizontal">

                <fieldset class="content-group">

                    <div class="form-group">
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-md-6">

                                    <label>Cliente</label>
                                    <select data-placeholder="Seleccionar Cliente" class="select-size-lg" id="txtCliente">
                                        <option disabled selected value="">Selecciona Un cliente</option>
                                        <option value="0">Todos</option>
                                        <?php
                                        foreach ($listaClientes->result() as $row) :
                                        ?>
                                            <option value="<?php echo $row->idCliente ?>"><?php echo $row->nombres . " " . $row->primerApellido . " " . $row->segundoApellido  ?> </option>

                                        <?php
                                        endforeach;
                                        ?>

                                    </select>



                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-4">

                                    <label>Fecha de Inicio</label>
                                    <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" disabled>

                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-4">

                                    <label>Fecha Final</label>
                                    <input type="date" name="fechaFinal" id="fechaFinal" class="form-control" disabled>

                                </div>
                                <div class="col-md-2">
                                    <a href="#" id="btnHabilitarFechas" class="btn btn-primary">Habilitar Fechas</a>

                                </div>

                            </div>
                            <p class="text-danger" style="display:none;" id="fechaIncorrecta">La fecha final debe ser mayor a la fecha de inicio</p>
                            <p class="text-danger" id="fechaVacia" style="display:none;">Se debe ingresar las fechas de inicio y final</p>
                            <p class="text-danger" id="sinCliente" style="display:none;">Se debe elegir un cliente o todos</p>
                        </div>
                    </div>
                </fieldset>

                <div class="text-left">
                    <button class="btn btn-success" id="btnGuardar" name="btnGuardar">Generar Reporte <i class="icon-arrow-right14 position-right"></i></button>

                </div>
            </div>
            <!-- /form horizontal -->

        </div>