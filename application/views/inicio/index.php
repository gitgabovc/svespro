<style>
    .box-shadow-p {


        border-radius: 10px;
        /* box-shadow: rgba(17, 17, 26, 0.1) 0px 8px 24px,rgba(17, 17, 26, 0.1) 0px 16px 56px, rgba(17, 17, 26, 0.1) 0px 24px 80px; */
        box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
    }

    .d-g {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 10px;
        ;
    }

    .p-3 {
        padding: 15px;
    }

    .p-2 {
        padding: 10px;
    }


    @media (min-width:768px) {
        .h-200 {
            height: 200px;
        }
    }

    .min-h-500 {
        min-height: 500px;
    }

    .mt-3 {
        margin-top: 0px;
    }

    @media (min-width:768px){
        .mt-3 {
        margin-top: 30px;
    }
    }

    .m-g {
        margin-left: 0px;
        margin-right: 5px;
    }

    .saludo {
        padding-left: 40px;
        padding-top: 20px;

    }

    .message {
        margin-left: 28px;
        font-size: 15px;
    }

    .welcom {
        font-size: 30px;
    }

    .titulo-ventas {
        font-size: 15px;
        margin-bottom: 0px;
    }

    .monto-ventas {
        font-size: 30px;
    }

    .fs {
        padding: 10px;
        font-size: 30px;
        border-radius: 10px;
    }

    .segundo div {
        margin-top: 30px;
    }

    @media (min-width:768px) {
        .segundo div {
            margin-top: 0px;
        }
    }
    .mt-33{
        margin-top:28px;
    }

    @media (min-width:768px){
        .mt-33{
        margin-top:0px;
    }
    }
</style>

<div class="container">
    <div class="row primero">

        <div class="col-md-7 bg-white box-shadow-p h-200 ">
            <div class="saludo">
                <h3 class="welcom text-primary-400">👋 Bienvenido <?php echo $this->session->userdata('nombres') ?></h3>
                <p class="message text-slate-600">No tienes ningun mensaje </p>
            </div>
            <div class="imagen">

            </div>
        </div>
        <div class="col-md-5 d-g h-200 mt-33">
            <div class="ventas-hoy bg-white box-shadow-p p-3 m-g">
                <div class="cont-m ">
                    <i class="icon-coin-dollar bg-success-300  fs"></i>
                </div>
                <h4 class="titulo-ventas text-slate">Ventas Del Día</h4>
                <p class="monto-ventas text-slate-300">Bs <?php echo $totalVentaDia->row()->sumaVentasHoy  ?></p>
            </div>
            <div class="ventas-mes bg-white box-shadow-p p-3 m-g">
                <div class="cont-m ">
                    <i class="icon-cart4 bg-info-300  fs"></i>
                </div>
                <h4 class="titulo-ventas text-slate">Ventas Del Mes</h4>
                <p class="monto-ventas text-slate-300">Bs <?php echo $totalVentaMes->row()->sumaVentasMesActual  ?></p>
            </div>

        </div>


    </div>
    <div class="row segundo mt-3">
        <div class="col-md-4 ">
            <div class="lista-ventas box-shadow-p bg-white m-g min-h-500">
                <!-- Daily sales -->
                <div class="panel-heading">
                    <h6 class="panel-title text-slate">Ventas Del Día</h6>

                </div>

                <div class="panel-body">
                    <div id="sales-heatmap"></div>
                </div>

                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Hora</th>
                                <th>Total (Bs)</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($listaVentasHoy->result() as $row) : ?>

                                <tr>
                                    <td>


                                        <div class="media-body">
                                            <div class="media-heading text-primary">
                                                <?php echo $row->nombres . " " . $row->primerApellido; ?>
                                            </div>

                                            <div class="text-muted text-size-small">Cod. Venta: <?php echo $row->idVenta; ?></div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted text-size-small"><?php echo mostrarSoloHoraDeFecha($row->fechaRegistro); ?> </span>
                                    </td>
                                    <td>
                                        <h6 class="text-semibold no-margin"><?php echo $row->precioUnitario; ?></h6>
                                    </td>
                                </tr>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                </div>
                <!-- /daily sales -->
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="lista-productos-minimo box-shadow-p bg-white m-g min-h-500">
                <!-- Daily sales -->
                <div class="panel-heading">
                    <h6 class="panel-title text-slate">Productos Por Agotarse</h6>

                </div>

                <div class="panel-body">
                    <div id="sales-heatmap"></div>
                </div>

                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cantidad
                                    <div>Unidades</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listaProductosMinimos->result() as $row) : ?>

                                <tr>
                                    <td>


                                        <div class="media-body">
                                            <div class="media-heading text-primary">
                                                <?php echo $row->nombreProducto; ?>
                                            </div>

                                            <div class="text-muted text-size-small">Categoria: <?php echo $row->nombreCategoria; ?></div>
                                        </div>
                                    </td>

                                    <td>
                                        <h6 class="text-semibold no-margin"><?php echo $row->stock; ?></h6>
                                    </td>
                                </tr>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                </div>
                <!-- /daily sales -->
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="lista-productos box-shadow-p bg-white m-g min-h-500">
                <!-- Daily sales -->
                <div class="panel-heading">
                    <h6 class="panel-title text-slate">Productos Más Vendidos</h6>
                    
                </div>

                <div class="panel-body">
                    <div id="sales-heatmap"></div>
                </div>

                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cantidad (Mes)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listaProductosTopMes->result() as $row) : ?>

                                <tr>
                                    <td>


                                        <div class="media-body">
                                            <div class="media-heading text-primary">
                                                <?php echo $row->nombreProducto; ?>
                                            </div>

                                            <div class="text-muted text-size-small">Categoria: <?php echo $row->nombreCategoria; ?></div>
                                        </div>
                                    </td>

                                    <td>
                                        <h6 class="text-semibold no-margin"><?php echo $row->totalCantidad; ?></h6>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <!-- /daily sales -->
            </div>
        </div>

    </div>
</div>