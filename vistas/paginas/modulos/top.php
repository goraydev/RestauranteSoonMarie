<?php
/* Sumar todos los pagos de las ventas */
$sumaPrecioPagar = ControladorInicio::ctrSumarVentas();

/* Mostrar la cantidad de reservas */
$totalReservas = ControladorInicio::ctrMostrarReservas();

/* Mostrar el total de platos que hay */
$totalPlatos = ControladorInicio::ctrMostrarPlatos();

/* Mostrar el total de platos que hay */
$totalEmpleados = ControladorInicio::ctrMostrarEmpleados();

?>



<!--=====================================
Sumar toda la columna de los detalle reservas
======================================-->

<div class="col-12 col-sm-6 col-lg-3">

    <div class="small-box bg-success">

        <div class="inner">

            <h3>S/. <span><?php echo number_format($sumaPrecioPagar["total"], 2, ",", "."); ?></span></h3>

            <p class="text-uppercase">Precios Totales</p>

        </div>

        <div class="icon">

            <i class="fas fa-money-bill-wave"></i>

        </div>

        <a href="detallereservas" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

    </div>

</div>

<!--=====================================
Total Reservas
======================================-->

<div class="col-12 col-sm-6 col-lg-3">

    <div class="small-box bg-primary">

        <div class="inner">

            <h3><?php echo $totalReservas["totalReservas"]; ?></h3>

            <p class="text-uppercase">Reservas</p>

        </div>

        <div class="icon">

            <i class="fas fa-calendar-check"></i>

        </div>

        <a href="detallereservas" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

    </div>

</div>

<!--=====================================
Total de platos
======================================-->

<div class="col-12 col-sm-6 col-lg-3">

    <div class="small-box bg-secondary">

        <div class="inner">

            <h3><?php echo $totalPlatos["totalPlatos"]; ?></h3>

            <p class="text-uppercase">platos</p>

        </div>

        <div class="icon">

            <i class="fas fa-utensils"></i>

        </div>

        <a href="platos" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

    </div>

</div>

<!--=====================================
Total de empleados
======================================-->

<div class="col-12 col-sm-6 col-lg-3">

    <div class="small-box bg-danger">

        <div class="inner">

            <h3><?php echo $totalEmpleados["totalEmpleados"]; ?></h3>

            <p class="text-uppercase">Empleados</p>

        </div>

        <div class="icon">

            <i class="fa fa-users"></i>

        </div>

        <a href="administradores" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>

    </div>

</div>