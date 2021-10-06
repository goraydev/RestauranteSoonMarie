<?php
require "conexion.php";

$codTurno = $_GET['codTurno'];
$sql = "SELECT * FROM turnos WHERE idTurnos = '$codTurno'";
$resultado = $mysqli->query($sql);
$row = $resultado->fetch_array(MYSQLI_ASSOC);
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
    <title>Actualizar horarios del turno</title>
</head>

<body>
    <div class="container" style="display: flex; flex-direction: column;align-items: center;">
        <div class=" row">
            <h3>Actualizar horarios del turno</h3>
        </div>
        <div class="card" style="width: 20rem;">
            <img src="vistas/img/plantilla/cooking.svg" class="card-img-top" alt="...">
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="updateTurno.php" autocomplete="off">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-append input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                            <input type="text" class="form-control" name="codTurno" value="<?php echo $row['idTurnos']; ?>" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append input-group-text">
                                <span class="fas fa-hamburger"></span>
                            </div>
                            <input type="text" class="form-control" name="categoria" value="<?php echo $row['descripcion']; ?>" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append input-group-text">
                                <span class="fas fa-clock"></span>
                            </div>
                            <input type="time" class="form-control" name="inicioTurno" value="<?php echo $row['inicio']; ?>">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append input-group-text">
                                <span class="fas fa-clock"></span>
                            </div>
                            <input type="time" class="form-control" name="finTurno" value="<?php echo $row['fin']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2">
                            <a href="turno" class="btn btn-default">Regresar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>