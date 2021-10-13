<?php
require "conexion.php";

$codReserva = $_GET['codReserva'];
$sql = "DELETE FROM detallereservas WHERE fk_reserva = '$codReserva'";
$resultado = $mysqli->query($sql);

/*Para traer toda la tabla de reserva con ese codigo */
$sql2 = "SELECT * FROM reservas WHERE codReserva = '$codReserva'";
$resultado2 = $mysqli->query($sql2);
$row2 = $resultado2->fetch_array(MYSQLI_ASSOC);

/* Variable que contiene el numero de comensales de la tabla reservas */
$numComensales = $row2["numComensales"];

/* Variable que contiene el codigo del cliente */
$fkCliente = $row2["fk_codCliente"];

/* Variable que contiene el horario y la descripcion de la tabla turnos */
$fkTurnos = $row2["fk_idTurnos"];

/* Modificamos la capacidad del turno */
$sql3 = "UPDATE turnos SET capacidad = capacidad+'$numComensales' WHERE idTurnos = '$fkTurnos'";
$resultado3 = $mysqli->query($sql3);


/* Traemos la tabla clientes con ese codigo */
$sql4 = "SELECT * FROM clientes WHERE codCliente = '$fkCliente'";
$resultado4 = $mysqli->query($sql4);
$row4 = $resultado4->fetch_array(MYSQLI_ASSOC);

/* Variable que contiene el codigo de la persona */
$fk_idPerson = $row4["fk_idPerson"];

/* Eliminamos la fila de la reserva */
$sql5 = "DELETE FROM reservas WHERE codReserva = '$codReserva'";
$resultado5 = $mysqli->query($sql5);

/* Eliminamos al cliente de la tabla clientes*/
$sql6 = "DELETE FROM clientes WHERE codCliente = '$fkCliente'";
$resultado6 = $mysqli->query($sql6);

/* Eliminamos a esa persona que fue cliente */
$sql7 = "DELETE FROM personas WHERE idPerson = '$fk_idPerson'";
$resultado7 = $mysqli->query($sql7);




?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="zmfNZmXoNWBMemUOo1XUGFfc0ihGGLYdgtJS3KCr/l0=">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <title>Eliminar reserva</title>
</head>

<body>
    <div class="container" style="display: flex; flex-direction: column;align-items: center;">
        <div class=" row">
            <h3>Eliminar reserva</h3>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="vistas/img/plantilla/cooking.svg" class="card-img-top" alt="...">
            <div class="card-body">
                <?php
                if ($resultado6) { ?>
                    <h3>reserva eliminada</h3>
                <?php
                } else { ?>
                    <h3>No se pudo eliminar</h3>
                <?php
                }
                ?>
                <div class="form-group">
                    <div class="col-sm-offset-2">
                        <a href="platos" class="btn btn-primary">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>