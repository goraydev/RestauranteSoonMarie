<?php
$mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
if ($mysqli->connect_error) {
    die('Error en la conexión' . $mysqli->connect_error);
}

$codTipoPlato = $_GET['codPlato'];
$sql = "SELECT * FROM tipos WHERE codTipo = '$codTipoPlato'";
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
    <title>Actualizar registro</title>
</head>

<body>
    <div class="container" style="display: flex; flex-direction: column;align-items: center;">
        <div class=" row">
            <h3>Actualizar categoria</h3>
        </div>
        <div class="card" style="width: 20rem;">
            <img src="vistas/img/plantilla/cooking.svg" class="card-img-top" alt="...">
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="updateTipoPlato.php" autocomplete="off">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-append input-group-text">
                                <span class="fas fa-users-cog"></span>
                            </div>
                            <input type="text" class="form-control" name="codTipo" value="<?php echo $row['codTipo']; ?>" readonly>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-append input-group-text">
                                <span class="fas fa-users-cog"></span>
                            </div>
                            <input type="text" class="form-control" name="descripcion" value="<?php echo $row['descripcion']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2">
                            <a href="tipoPlatos" class="btn btn-default">Regresar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>