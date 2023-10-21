<?php
//var_dump($getEstudiante);
//print_r($getCategoria->result())

?>


<div class="tab-pane" id="messages-mon">
    <!-- Form horizontal -->
    <div class="panel panel-flat">

        <div class="panel-body">

            <form class="form-horizontal" action="<?php echo base_url('talla/update') ?>" method="POST">

                <fieldset class="content-group">
                    <?php foreach ($getTalla->result() as $row) { ?>
                        <input type="hidden" name="idTalla" value="<?php echo $row->idTalla; ?>">
                        <div class="form-group">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group has-feedback has-feedback-left">
                                            <input type="text" class="form-control input-xlg" id="talla" name="talla" value="<?php echo $row->talla; ?>">
                                            <div class="form-control-feedback">
                                                <i class="icon-office"></i>
                                            </div>
                                        </div>



                                    </div>

                                    <div class="col-md-6">






                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </fieldset>

                <div class="text-right">
                    <a type="submit" class="btn btn-primary" id="btnGuardar" name="btnCancelar" href="<?php echo base_url("talla"); ?>">Cancelar </a>

                    <button type="submit" class="btn btn-primary" id="btnGuardar" name="btnGuardar">Guardar <i class="icon-arrow-right14 position-right"></i></button>
                </div>

            </form>
        </div>
    </div>
    <!-- /form horizontal -->

</div>