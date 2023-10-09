<?php
//var_dump($getEstudiante);
//print_r($getProducto->result())

?>


<div class="tab-pane" id="messages-mon">
    <!-- Form horizontal -->
    <div class="panel panel-flat">

        <div class="panel-body">

            <form class="form-horizontal" action="<?php echo base_url('empleado/update') ?>" method="POST">

                <fieldset class="content-group">
                    <?php foreach ($getEmpleado->result() as $row) { ?>
                        <input type="hidden" name="txtIdEmpleado" value="<?php echo $row->idEmpleado; ?>">
                        <div class="form-group">
                            <div class="col-lg-10">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group has-feedback has-feedback-left">
                                        <label >Nombres:</label>

                                            <input type="text" class="form-control input-xlg" id="txtNombres" name="txtNombres" value="<?php echo $row->nombres; ?>">
                                            <div class="form-control-feedback">
                                                <i class="icon-office"></i>
                                            </div>
                                        </div>

                                        <div class="form-group has-feedback has-feedback-left">
                                        <label >Ap. Paterno:</label>

                                            <input type="text" class="form-control input-lg" id="txtPrimerApellido" name="txtPrimerApellido" value="<?php echo $row->primerApellido; ?>">
                                            <div class="form-control-feedback">
                                                <i class="icon-make-group"></i>
                                            </div>
                                        </div>

                                        <div class="form-group has-feedback has-feedback-left">
                                        <label >Ap. Materno:</label>

                                            <input type="text" class="form-control input-lg" id="txtSegundoApellido" name="txtSegundoApellido" value="<?php echo $row->segundoApellido; ?>">
                                            <div class="form-control-feedback">
                                                <i class="icon-make-group"></i>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback has-feedback-left">
                                        <label >Fecha Nacimiento:</label>

                                            <input type="date" class="form-control input-lg" id="txtFechaNacimiento" name="txtFechaNacimiento" value="<?php echo $row->fechaNacimiento; ?>">
                                            <div class="form-control-feedback">
                                                <i class="icon-make-group"></i>
                                            </div>
                                        </div>

                                        <div class="form-group has-feedback has-feedback-left">
                                        <label >Carnet Identidad:</label>

                                            <input type="text" class="form-control" id="txtCarnetIdentidad" name="txtCarnetIdentidad" value="<?php echo $row->carnetIdentidad; ?>">
                                            <div class="form-control-feedback">
                                                <i class="icon-droplets"></i>
                                            </div>
                                        </div>

                                        <div class="form-group has-feedback has-feedback-left">
                                        <label >Genero:</label>

                                            <select class="bootstrap-select" data-width="100%" id="cbxSexo" name="cbxSexo">
                                                <option value="" disabled >---- Seleccionar Genero --</option>
                                                <option value="m" <?php if($row->sexo=="m") echo"selected";?>>----- Masculito</option>
                                                <option value="f" <?php if($row->sexo=="f") echo"selected";?>>----- Femenino</option>


                                            </select>
                                            <div class="form-control-feedback">
                                                <i class="icon-droplets"></i>
                                            </div>
                                        </div>

                                        <div class="form-group has-feedback has-feedback-left">
                                        <label >telefono:</label>

                                            <input type="number" class="form-control" id="txtTelefono" name="txtTelefono" value="<?php echo $row->telefono; ?>">
                                            <div class="form-control-feedback">
                                                <i class="icon-droplets"></i>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback has-feedback-left">
                                        <label >Correo:</label>

                                            <input type="text" class="form-control" id="txtEmail" name="txtEmail" value="<?php echo $row->email; ?>">
                                            <div class="form-control-feedback">
                                                <i class="icon-droplets"></i>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group has-feedback has-feedback-left">
                                        <label >Cuenta:</label>

                                            <input type="text" class="form-control input-lg" placeholder="Cuenta" id="txtUsuario" name="txtUsuario" value="<?php echo $row->usuario?>">
                                            <div class="form-control-feedback">
                                                <i class="icon-make-group"></i>
                                            </div>
                                        </div>
                                        <div class="form-group has-feedback has-feedback-left">
                                            <label >Contraseña:</label>
                                            <input type="text" class="form-control input-lg" placeholder="Contraseña" id="txtPassword" name="txtPassword" value="<?php echo $row->password?>">
                                            <div class="form-control-feedback">
                                                <i class="icon-make-group"></i>
                                            </div>
                                        </div>


                                        <div class="form-group has-feedback has-feedback-left">
                                        <label >Tipo Usuario:</label>

                                            <select class="bootstrap-select" data-width="100%" id="cbxTipo" name="cbxTipo">
                                                <option value="" disabled >---- Seleccionar Tipo Usuario --</option>
                                                <option value="adm" <?php if($row->tipo=="adm") echo "selected";?>>----- Administrador</option>
                                                <option value="ven" <?php if($row->tipo=="ven") echo "selected";?>>----- Vendedor</option>


                                            </select>
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
                    <a class="btn btn-primary" id="btnCancelarE" href="<?php echo base_url(); ?>empleado" type="submit" name="action"><i class="fa fa-arrow-circle-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary" id="btnGuardar" name="btnGuardar">Guardar <i class="icon-arrow-right14 position-right"></i></button>

            </form>
        </div>
    </div>
    <!-- /form horizontal -->

</div>