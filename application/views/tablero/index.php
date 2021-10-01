<?php 

if (isset($totalVentasDia)) {
    $t=$totalVentasDia[0];
    $totalVentaDia=$t->totalVentaDia;
    $utilidadDia=$t->utilidadDia;
}else{
    $totalVentaDia=0;
    $utilidadDia=0;
}

if (isset($totalComprasDia)) {
    $t=$totalComprasDia[0];
    $totalCompraDia=$t->totalCompraDia;
}else{
    $totalCompraDia=0;
}


if (isset($capitalTarjetas)) {
    $c=$capitalTarjetas[0];
    $capitalTarjetas=$c->capitalTarjetas;
}else{
    $capitalTarjetas=0;
}


if (isset($capitalPrincipal)) {
    $cp=$capitalPrincipal[0];
    $capitalPrincipal=$cp->montoCapital;
}else{
    $capitalPrincipal=0;
}

if (isset($totalCredito)) {
    $tc=$totalCredito[0];
    $totalCredito=$tc->montoCredito;
}else{
    $totalCredito=0;
}

$efectivoCaja=$capitalPrincipal-$capitalTarjetas-$totalCredito;


//print_r('....................'.$total);


?>
<?php 
    if ($this->session->userdata('Escritorio')==1) {
?>

<!---script de confirmacion para delete-->
<script type="text/javascript">
  


</script>



<!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Title and breadcrumb -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- Container fluid scss in scafholding.scss -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales Summery -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col l3 m6 s12">
                        <div class="card danger-gradient card-hover">
                            <div class="card-content">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h6 class="white-text m-b-5">Bs.-</h6>
                                        <h3 class="white-text m-b-5"><?php echo $totalVentaDia ?></h3>
                                        <h6 class="white-text op-5 light-blue-text">Ventas del dia</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="white-text display-6"><i class="material-icons">assignment</i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col l3 m6 s12">
                        <div class="card info-gradient card-hover">
                            <div class="card-content">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h6 class="white-text m-b-5">Bs.-</h6>
                                        <h3 class="white-text m-b-5"><?php echo $totalCompraDia ?></h3>
                                        <h6 class="white-text op-5">Compras del dia</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="white-text display-6"><i class="material-icons">receipt</i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     
                    
                    <div class="col l3 m6 s12">
                        <div class="card success-gradient card-hover">
                            <div class="card-content">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h6 class="white-text m-b-5">Bs.-</h6>
                                        <h3 class="white-text m-b-5"><?php echo $utilidadDia ?></h3>
                                        <h6 class="white-text op-5 text-darken-2">Utilidad del dia</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col l3 m6 s12">
                        <div class="card warning-gradient card-hover">
                            <div class="card-content">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h6 class="white-text m-b-5">Bs.-</h6>
                                        <h3 class="white-text m-b-5"><?php echo $capitalPrincipal ?></h3>
                                        <h6 class="white-text op-5">Capital en Principal</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="white-text display-6"><i class="material-icons">attach_money</i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Sales Summery -->
                <!-- ============================================================== -->
                <div class="row">

                    <div class="col s12 l9">
                        <div class="card">
                            <div class="card-content">
                                
                                <!-- Sales Summery -->
                                <div class="p-t-20">
                                    <div class="row">

                                        <div class="col s12">
                                            


                                 <!-- column -->
                                <div class="card">
                                        <div class="card-content">
                                            <h4 class="card-title">Ventas Mensuales</h4>
                                            <div>
                                                <canvas id="grafico" height="100" ></canvas>
                                            </div>
                                        </div>
                                </div>
                                 <!-- column -->

                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col s12 l3">
                        
                            
                        <div class="row">
                            <div class="col l12 m6 s12">
                                <div class="card primary-gradient card-hover">
                                    <div class="card-content">
                                        <div class="d-flex no-block align-items-center">
                                            <div>
                                                <h6 class="white-text m-b-5">Bs.-</h6>
                                                <h3 class="white-text m-b-5"><?php echo $capitalTarjetas ?></h3>
                                                <h6 class="white-text op-5 light-blue-text">Capital en tarjetas</h6>
                                            </div>
                                            <div class="ml-auto">
                                                <span class="white-text display-6"><i class="material-icons">assignment</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col l12 m6 s12">
                                <div class="card success-gradient card-hover">
                                    <div class="card-content">
                                        <div class="d-flex no-block align-items-center">
                                            <div>
                                                <h6 class="white-text m-b-5">Bs.-</h6>
                                                <h3 class="white-text m-b-5"><?php echo $efectivoCaja ?></h3>
                                                <h6 class="white-text op-5 light-blue-text">Efectivo en caja</h6>
                                            </div>
                                            <div class="ml-auto">
                                                <span class="white-text display-6"><i class="material-icons">assignment</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col l12 m6 s12">
                                <div class="card primary-gradient card-hover">
                                    <div class="card-content">
                                        <div class="d-flex no-block align-items-center">
                                            <div>
                                                <h6 class="white-text m-b-5">Bs.-</h6>
                                                <h3 class="white-text m-b-5"><?php echo $totalCredito ?></h3>
                                                <h6 class="white-text op-5 light-blue-text">Total Deudas</h6>
                                            </div>
                                            <div class="ml-auto">
                                                <span class="white-text display-6"><i class="material-icons">assignment</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
<!--
                        <div class="card card-hover">
                            <div class="card-content">
                                <div class="d-flex align-items-center">
                                    <div class="m-r-20">
                                        <h1 class=""><i class="ti-pie-chart"></i></h1></div>
                                    <div>
                                        <h3 class="card-title">Artículo más Vendido</h3>
                                        <h6 class="card-subtitle">Entel 10</h6> 
                                    </div>
                                </div>
                                <div class="row d-flex align-items-center">
                                    <div class="col s6">
                                        <h3 class="font-light m-t-10">10500 unid</h3>
                                    </div>
                                    <div class="col s6 p-t-10 p-b-20 right-align">
                                        <div class="p-t-10 p-b-10 m-r-20">
                                            <div class="spark-count2" style="height:65px"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> del tablero anterior
-->
                    </div>
                </div>

                
                
            </div>
            <!-- ============================================================== -->
            <!-- Container fluid scss in scafholding.scss -->
            <!-- ============================================================== -->

        </div>
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->

<?php 
}
?>

        <script type="text/javascript">
          // -17.426133, -66.114632 unidad educativa Libertad  Villa Urqupiña

          var map=L.map('mapid').setView([-17.426133, -66.114632],17);

           L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
            maxZoom: 18
        }).addTo(map);



           // para graficos


       
        





        </script>