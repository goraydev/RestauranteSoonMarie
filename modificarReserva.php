<?php
require "conexion.php";

$codReserva = $_GET["codReserva"];
$sql = "SELECT * FROM reservas WHERE codReserva = '$codReserva'";
$resultado = $mysqli->query($sql);
$row = $resultado->fetch_array(MYSQLI_ASSOC);

$sql2 = "SELECT * FROM v_reservas WHERE codReserva = '$codReserva'";
$resultado2 = $mysqli->query($sql2);
$row2 = $resultado2->fetch_array(MYSQLI_ASSOC);

/* Variable que contiene el codigo del cliente */
$fkCliente = $row["fk_codCliente"];

/* Variable que contiene el codigo de la reserva */
$fkReserva = $row["codReserva"];

/* Variable que contiene el horario y la descripcion de la tabla turnos */
$fkTurnos = $row["fk_idTurnos"];

/* Consultamos a la tabla de turnos en la que sea igual a la reserva*/
$sql3 = "SELECT * FROM turnos WHERE idTurnos = '$fkTurnos'";
$resultado3 = $mysqli->query($sql3);
$row3 = $resultado3->fetch_array(MYSQLI_ASSOC);


/* Consultamos a la tabla de turnos en la que sea diferente a la reserva*/
$sql4 = "SELECT * FROM turnos WHERE idTurnos != '$fkTurnos'";
$resultado4 = $mysqli->query($sql4);


/* Para mostrar el plato reservado*/
$sql5 = "SELECT * FROM detallereservas WHERE fk_reserva ='$fkReserva'";
$resultado5 = $mysqli->query($sql5);
$row5 = $resultado5->fetch_array(MYSQLI_ASSOC);


/* Variable que contiene el codigo del plato reservado */
$fkPlato = $row5["fk_platos"];

/* Mostramos el nombre de los platos que haya seleccionado */
$sql6 = "SELECT * FROM platos WHERE codPlato = '$fkPlato'";
$resultado6 = $mysqli->query($sql6);
$row6 = $resultado6->fetch_array(MYSQLI_ASSOC);


/* Mostramos el nombre de los platos que no hayan seleccionado */
$sql7 = "SELECT * FROM platos WHERE codPlato != '$fkPlato'";
$resultado7 = $mysqli->query($sql7);

/* Mostramos el id persona del cliente */
$sql8 = "SELECT * FROM clientes WHERE codCliente = '$fkCliente'";
$resultado8 = $mysqli->query($sql8);
$row8 = $resultado8->fetch_array(MYSQLI_ASSOC);

/* Variable que almacena el fk de la persona que es cliente */
$fkPersona = $row8["fk_idPerson"];

/* Mostramos el id de la tabla personas del cliente respectivo */
$sql9 = "SELECT * FROM personas WHERE idPerson = '$fkPersona'";
$resultado9 = $mysqli->query($sql9);
$row9 = $resultado9->fetch_array(MYSQLI_ASSOC);


?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="vistas/img/plantilla/cooking.svg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="zmfNZmXoNWBMemUOo1XUGFfc0ihGGLYdgtJS3KCr/l0=">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <title>Actualizar reserva</title>
</head>

<body>
    <div class="container" style="display: flex; flex-direction: column;align-items: center;">
        <div class=" row">
            <h3>Actualizar datos de la reserva</h3>
        </div>
        <div class="card" style="width: 50rem;">
            <div class="card-body">
                <form class="row g-3" method="POST" action="updateReservas.php" autocomplete="off">
                    <div class="col-md-4">
                        <label for="codReserva" class="form-label">Código de reserva</label>
                        <input type="text" class="form-control" id="codReserva" name="codReserva" value="<?php echo $row["codReserva"]; ?>" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="nombreCliente" class="form-label">Cliente</label>
                        <input type="text" class="form-control" id="nombreCliente" value="<?php echo $row2["Cliente"]; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="dirCliente" class="form-label">Dirección</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="dirCliente" name="dirCliente" value="<?php echo $row9["direccion"]; ?>">
                        </div>
                    </div>
                    <div class="col-md-7">
                        <label for="validationDefault04" class="form-label">Descripción y horario</label>
                        <select class="form-select" name="modificarTurno" id="validationDefault04">
                            <option disabled value="">Seleccione turno</option>
                            <option value="<?php echo $row3["idTurnos"]; ?>" selected><?php echo $row3["descripcion"] . ' de ' . $row3["inicio"] . ' a ' . $row3["fin"] . ' | Disponible: ' . $row3["capacidad"] ?></option>
                            <?php
                            if ($resultado4) {
                                while (($row4 = $resultado4->fetch_array(MYSQLI_ASSOC)) > 0) {
                                    echo "<option value='" . $row4['idTurnos'] . "'>" . $row4['descripcion'] . ' de ' . $row4["inicio"] . ' a ' . $row4["fin"] . ' | Disponible: ' . $row4["capacidad"] . "</option>";
                                }
                            } else {
                                echo "sin categorias";
                            }
                            ?>
                        </select>
                    </div>

                    <input type="text" style="display: none;" name="actualTurno" value="<?php echo $row3["idTurnos"]; ?>">
                    <input type="text" style="display: none;" name="idPersona" value="<?php echo $row9["idPerson"]; ?>">
                    <input type="text" style="display: none;" name="numActualComensales" value="<?php echo $row["numComensales"]; ?>">
                    <input type="text" style="display: none;" name="nomActualPlato" value="<?php echo $row6["codPlato"]; ?>">
                    <input type="date" style="display: none;" name="actualFechaReserva" value="<?php echo $row5["fecha_reserva"]; ?>">



                    <div class="col-md-3">
                        <label for="numComensales" class="form-label">Número de comensales</label>
                        <input type="number" class="form-control" id="numComensales" name="numComensales" value="<?php echo $row["numComensales"]; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="validationDefault04" class="form-label">Plato reservado</label>
                        <select class="form-select" name="modificarPlato" id="validationDefault04">
                            <option disabled value="">Seleccione plato</option>
                            <option value="<?php echo $row6["codPlato"]; ?>" selected><?php echo $row6["nombrePlato"]; ?></option>
                            <?php
                            if ($resultado7) {
                                while ($row7 = $resultado7->fetch_array(MYSQLI_ASSOC)) {
                                    echo "<option value='" . $row7['codPlato'] . "'>" . $row7['nombrePlato'] . "</option>";
                                }
                            } else {
                                echo "sin categorias";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="numComensales" class="form-label">Fecha reservada</label>
                        <input type="date" class="form-control" id="search_date" name="nuevaFechaReserva" value="<?php echo $row5["fecha_reserva"]; ?>">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2">
                            <a href="reservas" class="btn btn-default">Regresar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script src="vistas/js/reservas.js"></script>
</body>

</html>