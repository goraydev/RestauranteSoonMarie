<?php
$mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
if ($mysqli->connect_error) {
    die('Error en la conexión' . $mysqli->connect_error);
}

$DNI = $_GET['DNI'];
$sql = "CALL p_deleteEmp('$DNI')";
$resultado = $mysqli->query($sql);
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
    <title>Eliminar registros</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="row" style="text-align: center;">
                    <?php
                    if ($resultado) { ?>
                        <h3>Registro eliminado</h3>
                    <?php
                    } else { ?>
                        <h3>No se pudo eliminar</h3>
                    <?php
                    }
                    ?>
                    <a href="index.php" class="btn btn-primary">Regresar</a>


                </div>
            </div>
        </div>
    </div>

</body>

</html>