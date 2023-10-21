<?php
//var_dump($getEstudiante);
//print_r($getProducto->result())

?>


<div class="tab-pane" id="messages-mon">
    <!-- Form horizontal -->
    <div class="panel panel-flat">

        <div class="panel-body">

            <form class="form-horizontal" action="<?php echo base_url('cliente/update') ?>" method="POST">

                <fieldset class="content-group">
                    <?php foreach ($getCliente->result() as $row) { ?>
                        <input type="hidden" name="txtIdCliente" value="<?php echo $row->idCliente; ?>">
                        <div class="form-group">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group has-feedback has-feedback-left">
                                            <input type="text" class="form-control input-xlg" id="txtNombres" name="txtNombres" value="<?php echo $row->nombres; ?>">
                                            <div class="form-control-feedback">
                                                <i class="icon-office"></i>
                                            </div>
                                        </div>

                                        <div class="form-group has-feedback has-feedback-left">
                                            <input type="text" class="form-control input-lg" id="txtPrimerApellido" name="txtPrimerApellido" value="<?php echo $row->primerApellido; ?>">
                                            <div class="form-control-feedback">
                                                <i class="icon-make-group"></i>
                                            </div>
                                        </div>

                                        <div class="form-group has-feedback has-feedback-left">
                                            <input type="text" class="form-control input-lg" id="txtSegundoApellido" name="txtSegundoApellido" value="<?php echo $row->segundoApellido; ?>">
                                            <div class="form-control-feedback">
                                                <i class="icon-make-group"></i>
                                            </div>
                                        </div>





                                        <div class="form-group has-feedback has-feedback-left">
                                            <input type="number" class="form-control" id="txtTelefono" name="txtTelefono" value="<?php echo $row->telefono; ?>">
                                            <div class="form-control-feedback">
                                                <i class="icon-droplets"></i>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </fieldset>

                <div class="text-right">
                    <a type="submit" class="btn btn-primary" id="btnGuardar" name="btnCancelar" href="<?php echo base_url("cliente"); ?>">Cancelar </a>
                    <button type="submit" class="btn btn-primary" id="btnGuardar" name="btnGuardar">Guardar <i class="icon-arrow-right14 position-right"></i></button>
                </div>

            </form>
        </div>
    </div>
    <!-- /form horizontal -->

</div>