

<!---script de confirmacion para delete-->
<script type="text/javascript">
  function preguntar(id){

    if (confirm('¿Esta realmente segur@ de CANCELAR la deuda..?')) 
    {
      window.location.href="creditos/delete"+"/"+id;

    }
  }

function enviarID(idPersona)
{
  //alert(idPersona);
$('#txtIdPersona').val(idPersona);

}


  
</script>



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
                            <div class="col s12">
                                <ul class="tabs">
                                    <li class="tab col s3"><a class="active" href="#lista"><b>Lista Deudas</b></a></li>
<!--
                                    <li class="tab col s3"><a href="#test3"><b>Agregar</b></a></li>
-->
                                </ul>
                            </div>
                            <div id="lista" class="col s12">
                                
                    <!-- inicio tabla lista -->
                        <div class="divider"></div>

                                <table id="file_export" class="table table-striped table-bordered display">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Cliente</th>
                                                            <th>Monto deuda</th>
                                                            <th>Opcion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        

                                                             <?php
                                              $indice=1;
                                              foreach($creditos->result() as $row) 
                                              {
                                               ?>
                                               <tr>
                                                <td><?php echo $indice; ?></td>
                                                <td><?php echo $row->cliente; ?></td>
                                                <td><?php echo $row->saldoDeuda; ?></td>
                                                <td>
                                            <center>

                                              <!-- Modal Trigger -->
                                              <button data-target="modal1" class="btn modal-trigger" onclick="enviarID(<?php echo $row->idPersona;?>)" >A cuenta</button>

                                              <!--
                                             
                                              
                                                <a class="btn-floating btn-small red" onclick="preguntar(<?php echo $row->idCredito;?>)">
                                                <i class="large material-icons">close</i>
                                              </a>
                                              <a class="btn-floating btn-small cyan" href="<?php echo base_url('ventas/recibopdf')."/".$row->idPersona; ?>">
                                                <i class="large material-icons">print</i>
                                              </a>
                                              -->
                                              <a class="btn-floating btn-small cyan" href="<?php echo base_url('creditos/detalleCreditos')."/".$row->idPersona; ?>">
                                                <i class="large material-icons">visibility</i>
                                              </a>
                                                <a class="btn-floating btn-small red" onclick="preguntar(<?php echo $row->idPersona;?>)">
                                                <i class="large material-icons">close</i>
                                              </a>

                                            </center>
                                                 </td>
                                               </tr>
                                               <?php
                                               $indice++; 
                                              }
                                              ?>          
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Cliente</th>
                                                            <th>monto deuda</th>
                                                            <th>Opcion</th>
                                                        </tr>
                                                    </tfoot>
                                    </table>
                        <div class="divider"></div>
                    <!-- final tabla lista -->

                            </div>

                            
<!--
                            <div id="test3" class="col s12">...</div>
-->
                        </div>
                                
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal Modificar a cuenta del cliente -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4 id="prueba">Modificar saldo del Cliente</h4>

        <form action="<?php echo base_url('creditos/update') ?>" name="datosSaldo" id="datosSaldo" method="POST">
                                    <div class="form-body">
                                        <div class="divider"></div>

                                        <div class="card-content">
                                            <h6 class="font-medium">A Cuenta (Bs)</h6>
                                            <div class="row">
                                                <div class="col s12 m6 l4">
                                                    <div class="input-field">
                                                        <input id="txtIdPersona" name="txtIdPersona" type="hidden">
                                                        <input id="txtAcuenta" name="txtAcuenta" type="text">
                                                        <label for="f-name"><b>Bs.-</b></label>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                           
                                          
                                            
                                        </div>
                                       
                                        <div class="divider"></div>
                                        <div class="card-content">
                                            <div class="form-action">
                                                <button class="btn waves-effect waves-light cyan" id="btnGuardar"  name="btnGuardar"> <i class="fa fa-save"></i> Guardar
                                                </button>
                                                <a href="#!" class="btn waves-effect waves-light grey darken-4   modal-action modal-close" ><i class="fa fa-arrow-circle-left"></i> Cancelar
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
    </div>
    
</div>
