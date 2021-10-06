<?php
require "conexion.php";
$sql = "SELECT * FROM v_reservas";
$resultado = $mysqli->query($sql);

?>

<div class="content-wrapper" style="min-height: 1761.5px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestor de reservas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
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
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card card-warning">
                        <div class="card-header">
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#crearReserva">
                                Realizar nueva reserva
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped dt-responsive tablaCategorias" width="100%">

                                <thead>

                                    <tr>
                                        <th>Código de reserva</th>
                                        <th>Cliente</th>
                                        <th>Teléfono del cliente</th>
                                        <th>Dirección del cliente</th>
                                        <th>Empleado</th>
                                        <th>Turno</th>
                                        <th>Horario elegido</th>
                                        <th>Acciones</th>

                                    </tr>

                                </thead>

                                <tbody id="myTable">
                                    <?php
                                    while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                                        <tr>
                                            <td><?php echo $row['codReserva'] ?></td>
                                            <td><?php echo $row['Cliente'] ?></td>
                                            <td><?php echo $row['TelefonoCliente'] ?></td>
                                            <td><?php echo $row['DireccionCliente'] ?></td>
                                            <td><?php echo $row['Empleado'] ?></td>
                                            <td><?php echo $row['descripcion'] ?></td>
                                            <td><?php echo $row['Horario'] ?></td>
                                            <td>
                                                <button class='btn btn-primary btn-sm'><a href="modificarCat.php?codCat=<?php echo $row['codReserva']; ?>"><i class="far fa-edit text-white"></i></a></button>
                                                <button class='btn btn-danger btn-sm'><a href="#" data-href="eliminarCat.php?codCat=<?php echo $row['codReserva']; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete"><i class="fas fa-trash-alt text-white"></i></a></button>
                                            </td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            Footer
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



<!-- Para crear una nueva reserva -->
<div class="modal fade" id="crearReserva" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" autocomplete="off">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="staticBackdropLabel">Crear nuevo reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Seleccion del empleado -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span>Empleado:</span>
                        </div>
                        <select name="registroUser" id="" class="form-control" required>
                            <option value="" disabled selected>¿Quién eres?</option>
                            <?php
                            $mostrarTurnos = new ControladorReservas();
                            $mostrarTurnos->ctrMostrarEmpleados();
                            ?>
                        </select>
                    </div>
                    <hr>
                    <h5 style="text-align: center;">Registrar datos del cliente</h5>
                    <br>
                    <!-- Input nombre -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                        <input type="text" class="form-control" name="registroNombre" placeholder="Ingresa el nombre" required>
                    </div>
                    <!-- Input apellido paterno -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                        <input type="text" class="form-control" name="registroApellidoPat" placeholder="Ingresa el apellido paterno" required>
                    </div>

                    <!-- Input apellido materno -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                        <input type="text" class="form-control" name="registroApellidoMat" placeholder="Ingresa el apellido materno" required>
                    </div>

                    <!-- Input telefono -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-mobile-alt"></span>
                        </div>
                        <input type="text" class="form-control" name="registroNumTelefono" placeholder="Ingresa número de celular" required>
                    </div>

                    <!-- Input direccion -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-map-marked-alt"></span>
                        </div>
                        <input type="text" class="form-control" name="registroDireccion" placeholder="Ingresa direccion" required>
                    </div>
                    <!-- Input número de comensales -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user-friends"></span>
                        </div>
                        <input type="number" min="1" class="form-control" name="registroNumeroComensales" placeholder="Ingresa número de comensales" required>
                    </div>

                    <!-- Seleccion del turno -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-clock"></span>
                        </div>
                        <select name="registroTurno" id="" class="form-control" required>
                            <option value="" disabled selected>Seleccione un turno disponible</option>
                            <?php
                            $mostrarTurnos = new ControladorReservas();
                            $mostrarTurnos->ctrMostrarTurnos();
                            ?>
                        </select>
                    </div>

                    <!-- Seleccion del plato -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-utensils"></span>
                        </div>
                        <select name="registroPlato" id="" class="form-control" required>
                            <option value="" disabled selected>Seleccion de plato</option>
                            <?php
                            $mostrarPlatos = new ControladorReservas();
                            $mostrarPlatos->ctrMostrarPlatos();
                            ?>
                        </select>
                    </div>
                </div>
                <!-- Para el registro de reserva -->
                <?php
                $registroReserva = new ControladorReservas();
                $registroReserva->ctrRegistroReserva();
                ?>

                <div class=" modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>