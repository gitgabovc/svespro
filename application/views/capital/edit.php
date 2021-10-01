<?php
//var_dump($getArticulo);
//print_r($getArticulo->result())

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

                        <div class="row">
                            
                            
                            <div id="test2" class="col s12">
                    <!-- inicio form agregar --> 
                                <form action="<?php echo base_url('articulos/update') ?>"  method="POST">
                                    <div class="form-body">
                                        
                                        <div class="card-content">
                                            <h6 class="font-medium">Actualiza Artículos</h6>
                            <?php foreach ($getArticulo->result() as $row) { ?>
                            <input type="hidden" name="txtIdArticulo" value="<?php echo $row->idArticulo; ?>" >
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtNombre" name="txtNombre" type="text" value="<?php echo $row->nombre; ?>">
                                                        <label for="f-name">Nombre</label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="l-name" name="txtPrecioCompra" type="text" value="<?php echo $row->precioCompra; ?>">
                                                        <label for="l-name">Precio Compra</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtStock" name="txtStock" type="text" value="<?php echo $row->stock; ?>">
                                                        <label for="email1">Stock</label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtPrecioVenta" name="txtPrecioVenta"  type="text" value="<?php echo $row->precioVenta; ?>">
                                                        <label for="con1">Precio Venta</label>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="row">
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <?php 
                                                        $listaEmpresa=array();
                                                        foreach ($empresas->result() as $row1) { 
                                                            $listaEmpresa[$row1->idEmpresa]=$row1->nombreEmpresa;
                                                                 } 
                                                          echo form_dropdown('cbxEmpresa',$listaEmpresa,$row->idEmpresa,'class="form-control"');
                                                              ?>
                                                        <label for="email1">Empresa</label>
                                                    </div>
                                                </div>
                                                <div class="col s12 m6 l6">
                                                    <div class="input-field">
                                                        <input id="txtDescripcion" name="txtDescripcion" type="text" value="<?php echo $row->descripcion; ?>">
                                                        <label for="email1">Descripción</label>
                                                    </div>
                                                </div>
<!--
                                            <div class="row">
                                                 <div class="col s12 m6 l6">
                                                    <div class="file-field input-field">
                                                        
                                                        <div class="btn cyan">
                                                            <span>Imagen</span>
                                                            <input type="file">
                                                        </div>
                                                        
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
-->
                                            </div>
                                            
                                        </div>
                                <?php }?>
                                        <div class="divider"></div>
                                        <div class="card-content">
                                            <div class="form-action">
                                                <button class="btn waves-effect waves-light cyan" id="btnGuardar"  name="btnGuardarE"> <i class="fa fa-save"></i> Guardar
                                                </button>
                                                <a class="btn waves-effect waves-light grey darken-4" id="btnCancelarE" href="<?php echo base_url();?>articulos" type="submit" name="action"><i class="fa fa-arrow-circle-left"></i> Cancelar
                                                </a>
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