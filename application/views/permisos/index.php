

<!---script de confirmacion para delete-->
<script type="text/javascript">
  function preguntar(id){

    if (confirm('¿Esta realmente segur@ de Eliminar?')) 
    {
      window.location.href="usuarios/delete"+"/"+id;

    }
  }

  function cancelar(){

    alert('test2');
      window.location.href="usuarios/index";

    
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
                                    <li class="tab col s3"><a class="active" href="#lista"><b>Lista Permisos</b></a></li>
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
                                                            <th>Permiso</th>
                                                            <th>Opcion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        

                                                             <?php
                                              $indice=1;
                                              foreach($permisos->result() as $row) 
                                              {
                                               ?>
                                               <tr>
                                                <td><?php echo $indice; ?></td>
                                                <td><?php echo $row->nombre; ?></td>
                                                <td></td>
                                               </tr>
                                               <?php
                                               $indice++; 
                                              }
                                              ?>          
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Permiso</th>
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
            