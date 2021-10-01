
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

                        <div class="row">
                            
                            
                            <div id="test2" class="col s12">
                    <!-- inicio form agregar --> 
                    <form action="<?php echo base_url('personas/update') ?>"  method="POST">
                        <div class="form-body">
                    <?php foreach ($getPersona->result() as $row) { ?>
                            <input type="hidden" name="txtIdPersona" value="<?php echo $row->idPersona; ?>" >
                                        
                                        <div class="card-content">
                                            <h6 class="font-medium">Agregar Persona</h6>
                                            <div class="row">
                                                <div class="col s12 m6 l4">
                                                    <div class="input-field">
                                                        <input id="txtNombre" name="txtNombre" type="text" value="<?php echo $row->nombre; ?>">
                                                        <label for="f-name">Nombre</label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l4">
                                                    <div class="input-field">
                                                        <input id="txtPrimerApellido" name="txtPrimerApellido" type="text" value="<?php echo $row->primerApellido; ?>">
                                                        <label for="l-name">Apellido Paterno</label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l4">
                                                    <div class="input-field">
                                                        <input id="txtSegundoApellido" name="txtSegundoApellido" type="text" value="<?php echo $row->segundoApellido; ?>">
                                                        <label for="l-name">Apellido Materno</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <?php 
                                                $tipoDoc = array(
                                                                "Cedula" => "Cedula de Identidad",
                                                                "Pasaporte" => "Pasaporte",
                                                                "Libreta S.M." => "Libreta S. Militar",
                                                             );
                                                  echo form_dropdown('cbxTipoDocumento',$tipoDoc,$row->tipoDocumento,'class="form-control"');
                                                      ?>
                                                      <label for="email1">Tipo de Persona</label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtNumDocumento" name="txtNumDocumento"  type="text" value="<?php echo $row->numDocumento; ?>">
                                                        <label for="con1">Número de Documento</label>
                                                    </div>
                                                </div>
                                            </div>
                                          
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtDireccion" name="txtDireccion" type="text" value="<?php echo $row->direccion; ?>">
                                                        <label for="email1">Dirección</label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtTelefono" name="txtTelefono" type="text" value="<?php echo $row->telefono; ?>">
                                                        <label for="email1">Teléfono</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtEmail" name="txtEmail"  type="text" value="<?php echo $row->email; ?>">
                                                        <label for="con1">Correo Electrónico</label>
                                                    </div>
                                                </div>
                       
                                            </div>
                                            
                                        </div>

                                <?php }?>
                                        <div class="divider"></div>
                                        <div class="card-content">
                                            <div class="form-action">
                                                <button class="btn waves-effect waves-light cyan" id="btnGuardar"  name="btnGuardar"> <i class="fa fa-save"></i> Guardar
                                                </button>
                                                <a class="btn waves-effect waves-light grey darken-4" id="btnCancelar" href="<?php echo base_url('personas'); ?>"><i class="fa fa-arrow-circle-left"></i> Cancelar</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                    <!-- final form agregar -->
                            </div>

                            <div id="test3" class="col s12">...</div>
                        </div>
                                
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>