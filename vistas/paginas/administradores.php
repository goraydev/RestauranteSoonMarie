<div class="content-wrapper" style="min-height: 717px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestor de administradores</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Todas las reservas</a></li>
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
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#crearAdministrador">
                                Nuevo registro
                            </button>
                            <br><br>
                            <label for="myInput">Buscar empleado</label>
                            <input class="form-control" id="myInput" type="text" placeholder="Ingrese dato">
                        </div>
                        <br>

                        <div class="card-body">
                            <table class="table table-bordered table-striped dt-responsive tablaAdministradores" width="100%" id="TablaAdministradores">
                                <thead>
                                    <tr>
                                        <th>DNI</th>
                                        <th>Empleado</th>
                                        <th>usuario</th>
                                        <th>Categoria</th>
                                        <th>estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <tr>
                                        <?php
                                        $mostrarAdministrador = new ControladorAdministradores();
                                        $mostrarAdministrador->ctrMostrarAdministradores();

                                        ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<!-- Para realizar la búsqueda de los empleados -->
<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>


<!-- Para la ventana modal - CREAR ADMNISTRADORES-->

<div class="modal fade" id="crearAdministrador" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="staticBackdropLabel">Crear nuevo empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Input DNI -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                        <input type="text" class="form-control" name="registroDNI" placeholder="Ingresa el DNI" required>
                    </div>
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

                    <!-- Input password -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-user-lock"></span>
                        </div>
                        <input type="password" class="form-control" name="registroPassword" placeholder="Crea password" required>
                    </div>

                    <!-- Seleccion de categoria -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-id-card-alt"></span>
                        </div>
                        <select name="registroCategoria" id="" class="form-control" required>
                            <option value="" disabled selected>Seleccione categoria</option>
                            <?php
                            $mostrarOpciones = new ControladorAdministradores();
                            $mostrarOpciones->ctrMostrarOpciones();
                            ?>
                        </select>
                    </div>


                </div>
                <!-- Para el registro de administrador -->
                <?php
                $registroAdministrador = new ControladorAdministradores();
                $registroAdministrador->ctrRegistroAdministrador();
                ?>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>