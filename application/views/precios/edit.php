
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
                    <form action="<?php echo base_url('precios/update') ?>"  method="POST">
                        <div class="form-body">
                    <?php foreach ($getPersona->result() as $row) { ?>
                            <input type="hidden" name="txtIdPersona" value="<?php echo $row->idPersona; ?>" >
                                        
                                        <div class="card-content">
                                            
                                            <div class="row">
                                                <h6 class="font-medium">Editar precios del Cliente:</h6><h5><?php echo $row->nombre.' '.$row->primerApellido.' '.$row->segundoApellido; ?></h5>
                                            </div>
                                            <div class="divider"></div>

                                                    <div class="row">
                                                      <div class="col s12 m6 l8">
                                                        
                                                        <div class="col s12 m6 l3">
                                                            <div class="input-field">
                                                                <h6>Articulos</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                            <div class="input-field">
                                                                <h6>Precio Normal</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                            <div class="input-field">
                                                                <h6>Precio a Crédito</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                            <div class="input-field">
                                                                <h6>Precio Promoción</h6>
                                                            </div>
                                                        </div>
                                                      </div>
                                                    </div>
                              
                                                <?php // $preciosPer ya viene array desde el precios_model
                                                    foreach($preciosPer as $row) { ?> 
                                                    <div class="row">
                                                      <div class="col s12 m6 l8">
                                                        <div class="input-field">
                                                            <input type="hidden" id="idPrecio[]" name="idPrecio[]" value="<?php echo $row->idPrecio; ?>">
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                            <div class="input-field">
                                                                <input id="txtNombreArticulo[]" name="txtNombreArticulo[]" type="text" value="<?php echo $row->nombre; ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                            <div class="input-field">
                                                                <input id="txtPrecio[]" name="txtPrecio[]" type="number" step="0.0001" value="<?php echo $row->precio; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                            <div class="input-field">
                                                                <input id="txtPrecioCredito[]" name="txtPrecioCredito[]" type="number" step="0.0001" value="<?php echo $row->precioCredito; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col s12 m6 l3">
                                                            <div class="input-field">
                                                                <input id="txtPrecioPromo[]" name="txtPrecioPromo[]" type="number" step="0.0001" value="<?php echo $row->precioPromo; ?>">
                                                            </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                <?php } ?>
                                                         
                                            

                                        </div>
                                          
                                        
                                                                      
                                          
                                          
                                            
                                        </div>

                                <?php }?>
                                        <div class="divider"></div>
                                        <div class="card-content">
                                            <div class="form-action">
                                                <button class="btn waves-effect waves-light cyan" id="btnGuardar"  name="btnGuardar"> <i class="fa fa-save"></i> Guardar
                                                </button>
                                                <a class="btn waves-effect waves-light grey darken-4" id="btnCancelar" href="<?php echo base_url('precios'); ?>"><i class="fa fa-arrow-circle-left"></i> Cancelar</a>
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