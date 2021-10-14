<?php
require "conexion.php";

$DNI = $_GET['DNI'];
$sql = "SELECT * FROM v_empleados WHERE DNI = '$DNI'";
$resultado = $mysqli->query($sql);
$row = $resultado->fetch_array(MYSQLI_ASSOC);

/* SQL que obtiene los fk de la tabla empleados */
$sql2 = "SELECT * FROM empleados WHERE DNI = '$DNI'";
$resultado2 = $mysqli->query($sql2);
$row2 = $resultado2->fetch_array(MYSQLI_ASSOC);

/* Variable que obtiene el fk de la cuenta del empleado */
$fkCuenta = $row2["fk_idCuenta"];

/* Variable que obtiene el fk de la persona del empleado */
$fkPersona = $row2["fk_persona"];

/* Consultamos a la tabla cuentas */
$sql3 = "SELECT * FROM cuentas WHERE idCuenta = '$fkCuenta'";
$resultado3 = $mysqli->query($sql3);
$row3 = $resultado3->fetch_array(MYSQLI_ASSOC);


/* Variable que obtiene el fk de la cuenta para la tabla categorias */
$fkCodCategoria = $row3["fk_codCategoria"];

/* Consultamos a la tabla categorias */
$sql4 = "SELECT * FROM categorias WHERE codCategoria = '$fkCodCategoria'";
$resultado4 = $mysqli->query($sql4);
$row4 = $resultado4->fetch_array(MYSQLI_ASSOC);

/* Para mostrar las demás categorias, diferentes a la que tiene el empleado */
$sql5 = "SELECT * FROM categorias WHERE codCategoria != '$fkCodCategoria'";
$respuesta = $mysqli->query($sql5);

/* Para mostrar los datos del empleado y pueda modificar */
$sql6 = "SELECT * FROM personas WHERE idPerson = '$fkPersona'";
$resultado6 = $mysqli->query($sql6);
$row6 = $resultado6->fetch_array(MYSQLI_ASSOC);

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
            <h3>Actualizar datos del empleado</h3>
        </div>
        <div class="card" style="width: 50rem;">
            <div class="card-body">
                <form class="row g-3" method="POST" action="updateAdmin.php" autocomplete="off">
                    <!-- para enviar el fk_persona y poder modificar el número de telefono -->
                    <div class="col-md-4" style="display: none;">
                        <label for="fk_persona" class="form-label">fk_persona</label>
                        <input type="text" class="form-control" id="fk_persona" name="fk_persona" value="<?php echo $row2["fk_persona"]; ?>" readonly>
                    </div>

                    <!-- para enviar el fk_cuenta y poder modificar el cod de categoria y la contraseña -->
                    <div class="col-md-4" style="display: none;">
                        <label for="fk_cuenta" class="form-label">fk_persona</label>
                        <input type="text" class="form-control" id="fk_cuenta" name="fk_cuenta" value="<?php echo $row2["fk_idCuenta"]; ?>" readonly>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="dni" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="dni" name="nomEmpleado" value="<?php echo $row6["nombres"]; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="nombreEmpleados" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellPater" name="apellPater" value="<?php echo $row6["apellidoPat"]; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="nombreEmpleados" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellMater" name="apellMater" value="<?php echo $row6["apellidoMat"]; ?>">
                    </div>
                    
                    <div class="col-md-4">
                        <label for="username" class="form-label">Nombre de usuario</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="username" value="<?php echo $row["usuario"]; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="numTelefono" class="form-label">Teléfono/Celular</label>
                        <input type="text" class="form-control" id="numTelefono" name="numTelefono" value="<?php echo $row["numTelefono"]; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select class="form-select" name="modificarCategoria" id="validationDefault04">
                            <option selected disabled value="">Seleccione categoria</option>
                            <option value="<?php echo $row3["fk_codCategoria"]; ?>" selected><?php echo $row4["categoria"] ?></option>
                            <?php
                            if ($respuesta) {
                                while ($row5 = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                                    echo "<option value='" . $row5['codCategoria'] . "'>" . $row5['categoria'] . "</option>";
                                }
                            } else {
                                echo "sin categorias";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="nuevoPassword" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="nuevoPassword" name="nuevoPassword" placeholder="Crear nueva contraseña">
                    </div>
                    <!-- Para activar como administrador -->
                    <?php if (($row3["estado"] == 1) && $row2["DNI"] == '75182627') : ?>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="<?php echo $row3["estado"]  ?>" id="invalidCheck" checked disabled>
                                <label class="form-check-label" for="invalidCheck">
                                    Activar como administrador
                                </label>
                            </div>
                        </div>
                    <?php elseif (($row3["estado"] == 1)) : ?>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="estadoDesactivado" value="0" id="activado">
                                <label class="form-check-label" for="invalidCheck">
                                    Desactivar como administrador
                                </label>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="estadoDesactivado" value="1" id="desactivado">
                                <label class="form-check-label" for="invalidCheck">
                                    Activar como administrador
                                </label>
                            </div>
                        </div>
                    <?php endif ?>
                    <div class="col-12">
                        <div>
                            <small>Nota: <i>Al actualizar los datos del empleado también se cambiará automáticamente el nombre de usuario</i></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2">
                            <a href="administradores" class="btn btn-default">Regresar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

</body>

</html>