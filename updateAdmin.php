<?php
require "conexion.php";

$numTelefono = $_POST['numTelefono'];
$modificarCategoria = $_POST['modificarCategoria'];
$nuevoPassword = $_POST["nuevoPassword"];
$fk_persona = $_POST["fk_persona"];
$fk_cuenta = $_POST["fk_cuenta"];

/* Validamos la creación de una neuva contraseña */
if ($nuevoPassword == "") {
    $sql = "UPDATE personas SET numTelefono = '$numTelefono' WHERE idPerson = '$fk_persona'";
    $resultado = $mysqli->query($sql);
    $sql2 = "UPDATE cuentas SET fk_codCategoria = '$modificarCategoria' WHERE idCuenta = '$fk_cuenta'";
    $resultado2 = $mysqli->query($sql2);
} else {
    $sql = "UPDATE personas SET numTelefono = '$numTelefono' WHERE idPerson = '$fk_persona'";
    $resultado = $mysqli->query($sql);
    $sql2 = "UPDATE cuentas SET fk_codCategoria = '$modificarCategoria',password='$nuevoPassword' WHERE idCuenta = '$fk_cuenta'";
    $resultado2 = $mysqli->query($sql2);
}


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
    <title>Actualizar datos del empleado</title>
</head>

<body>
    <div class="container" style="display: flex; flex-direction: column;align-items: center;">
        <div class=" row">
            <h3>Actualizar Empleado</h3>
        </div>
        <div class="card" style="width: 18rem;">
            <img src="vistas/img/plantilla/cooking.svg" class="card-img-top" alt="...">
            <div class="card-body">
                <?php
                if ($resultado) { ?>
                    <h3>Datos actualizados</h3>
                <?php
                } else { ?>
                    <h3>No se pudo actualizar</h3>
                <?php
                }
                ?>
                <div class="form-group">
                    <div class="col-sm-offset-2">
                        <a href="administradores" class="btn btn-primary">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>