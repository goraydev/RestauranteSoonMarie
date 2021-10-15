<div class="content-wrapper" style="min-height: 1761.5px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Estadísticas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Todas las reservas</a></li>
                        <li class="breadcrumb-item active">Ver reportes</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <?php
                include "modulos/top.php";
                ?>
                <div class="col-12">
                    <?php

                    include "modulos/reservasVentas.php";

                    ?>

                </div>
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Reportes de reservas</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body card-horizontal">
                            <div class="container">
                                <div class="row row-cols-3">
                                    <div class="col">
                                        <div class="card" style="width: 16rem;">
                                            <img src="reportes/img/reservas.png" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Reporte de reservas</b></h5><br>
                                                <p class="card-text">Descargue todas las reservas realizadas hasta hoy</p>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button class="btn btn-danger"><a href="reportes/reservas/reportes.php" class="text-light" target="_blank" rel="noopener noreferrer">PDF</a></button>
                                                    <button class="btn btn-success"><a href="reportes/reservas/dexcel.php" class="text-light" target="_blank" rel="noopener noreferrer">XLS</a></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card" style="width: 16rem;">
                                            <img src="reportes/img/detallereservas.png" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Reporte general</b></h5><br>
                                                <p class="card-text">Descargue toda la tabla de la sección detalle reservas</p>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button class="btn btn-danger"><a href="reportes/detallereservas/reportes.php" class="text-light" target="_blank" rel="noopener noreferrer">PDF</a></button>
                                                    <button class="btn btn-success"><a href="reportes/detallereservas/dexcel.php" class="text-light" target="_blank" rel="noopener noreferrer">XLS</a></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="card" style="width: 16rem;">
                                            <img src="reportes/img/clientes.png" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Reporte de clientes</b></h5><br>
                                                <p class="card-text">Descargue todas los clientes que reservaron</p>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button class="btn btn-danger"><a href="reportes/clientes/reportes.php" class="text-light" target="_blank" rel="noopener noreferrer">PDF</a></button>
                                                    <button class="btn btn-success"><a href="reportes/clientes/dexcel.php" class="text-light" target="_blank" rel="noopener noreferrer">XLS</a></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Todos los reportes en un solo click
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Reportes de la empresa</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body card-horizontal">
                            <div class="container">
                                <div class="row row-cols-3">
                                    <div class="col">
                                        <div class="card" style="width: 16rem;">
                                            <img src="reportes/img/empleados.png" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Reporte de empleados</b></h5><br>
                                                <p class="card-text">Descargue toda la plantilla de empleados</p>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button class="btn btn-danger"><a href="reportes/empleados/reportes.php" class="text-light" target="_blank" rel="noopener noreferrer">PDF</a></button>
                                                    <button class="btn btn-success"><a href="reportes/empleados/dexcel.php" class="text-light" target="_blank" rel="noopener noreferrer">XLS</a></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card" style="width: 16rem;">
                                            <img src="reportes/img/platos.png" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Reporte de platos</b></h5><br>
                                                <p class="card-text">Descargue todas los platos, incluido su especialidad y tipo</p>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button class="btn btn-danger"><a href="reportes/platos/reportes.php" class="text-light" target="_blank" rel="noopener noreferrer">PDF</a></button>
                                                    <button class="btn btn-success"><a href="reportes/platos/dexcel.php" class="text-light" target="_blank" rel="noopener noreferrer">XLS</a></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card" style="width: 16rem;">
                                            <img src="reportes/img/cancelada.png" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><b>Reservas canceladas</b></h5><br>
                                                <p class="card-text">Reporte de las reservas canceladas</p>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button class="btn btn-danger"><a href="reportes/canceladas/reportes.php" class="text-light" target="_blank" rel="noopener noreferrer">PDF</a></button>
                                                    <button class="btn btn-success"><a href="reportes/canceladas/dexcel.php" class="text-light" target="_blank" rel="noopener noreferrer">XLS</a></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Todos los reportes en un solo click
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>