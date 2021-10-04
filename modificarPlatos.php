<?php
require "conexion.php";

$codPlato = $_GET['codPlatos'];
$sql = "SELECT * FROM platos WHERE codPlato = '$codPlato'";
$resultado = $mysqli->query($sql);
$row = $resultado->fetch_array(MYSQLI_ASSOC);

/*Variable que obtiene que especialidad es el plato */
$fkEspecialidad = $row["fk_codEspecialidad"];

/* Variable que obtiene el fk de tipos de plato */
$fkPlato = $row["fk_codTipo"];

/* Consultamos a la tabla especialidades que nombre posee el plato seleccionado */
$sql2 = "SELECT * FROM especialidades WHERE codEspecialidad = '$fkEspecialidad'";
$resultado2 = $mysqli->query($sql2);
$row2 = $resultado2->fetch_array(MYSQLI_ASSOC);

$sql3 = "SELECT * FROM especialidades WHERE codEspecialidad != '$fkEspecialidad'";
$respuesta = $mysqli->query($sql3);

/* Consultamos a la tabla tipos de platos */
$sql5 = "SELECT * FROM tipos WHERE codTipo ='$fkPlato'";
$resultado3 = $mysqli->query($sql5);
$row4 = $resultado3->fetch_array(MYSQLI_ASSOC);

$sql4 = "SELECT * FROM tipos WHERE codTipo != '$fkPlato'";
$respuesta2 = $mysqli->query($sql4);
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
    <title>Actualizar registro</title>
</head>

<body>
    <div class="container" style="display: flex; flex-direction: column;align-items: center;">
        <div class=" row">
            <h3>Actualizar plato</h3>
        </div>
        <div class="card" style="width: 20rem;">
            <img src="vistas/img/plantilla/cooking.svg" class="card-img-top" alt="...">
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="updatePlato.php" autocomplete="off">
                    <div class="form-group">
                        <!-- codigo -->
                        <div class="input-group mb-3">
                            <div class="input-group-append input-group-text">
                                <span class="fas fa-key"></span>
                            </div>
                            <input type="text" class="form-control" name="codPlatos" value="<?php echo $row['codPlato']; ?>" readonly>
                        </div>
                        <!-- Input del nombre -->
                        <div class="input-group mb-3">
                            <div class="input-group-append input-group-text">
                                <span class="fas fa-utensils"></span>
                            </div>
                            <input type="text" class="form-control" name="nombrePlato" value="<?php echo $row['nombrePlato']; ?>">
                        </div>
                        <!-- Inpot del precio -->
                        <div class="input-group mb-3">
                            <div class="input-group-append input-group-text">
                                <span class="fas fa-money-bill-wave"></span>
                            </div>
                            <input type="text" class="form-control" name="precio" value="<?php echo $row['precio']; ?>">
                        </div>
                        <!-- Seleccion de especialidad -->
                        <div class="input-group mb-3">
                            <div class="input-group-append input-group-text">
                                <span class="fas fa-medal"></span>
                            </div>
                            <select name="modificarEspecialidad" id="" class="form-control" required>
                                <option value="" disabled selected>Seleccione especialidad</option>
                                <option value="<?php echo $row["fk_codEspecialidad"]; ?>" selected><?php echo $row2["descripcion"] ?></option>
                                <?php
                                if ($respuesta) {
                                    while ($row3 = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                                        echo "<option value='" . $row3['codEspecialidad'] . "'>" . $row3['descripcion'] . "</option>";
                                    }
                                } else {
                                    echo "sin especialidades";
                                }
                                ?>

                            </select>
                        </div>

                        <!-- Seleccion de tipo de plato -->
                        <div class="input-group mb-3">
                            <div class="input-group-append input-group-text">
                                <span class="fas fa-leaf"></span>
                            </div>
                            <select name="modificarTipo" id="" class="form-control" required>
                                <option value="" disabled selected>Seleccione especialidad</option>
                                <option value="<?php echo $row["fk_codTipo"]; ?>" selected><?php echo $row4["descripcion"] ?></option>
                                <?php
                                if ($respuesta2) {
                                    while ($row5 = $respuesta2->fetch_array(MYSQLI_ASSOC)) {
                                        echo "<option value='" . $row5['codTipo'] . "'>" . $row5['descripcion'] . "</option>";
                                    }
                                } else {
                                    echo "sin especialidades";
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2">
                            <a href="platos" class="btn btn-default">Regresar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>