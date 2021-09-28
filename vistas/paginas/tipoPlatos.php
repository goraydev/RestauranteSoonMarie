<div class="content-wrapper" style="min-height: 1761.5px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestor de los tipo de platos</h1>
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
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#crearTipoPlato">
                                Nuevo registro
                            </button>
                            <br><br>
                            <label for="myInput">Buscar tipo de plato</label>
                            <input class="form-control" id="myInput" type="text" placeholder="Ingrese dato">

                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped dt-responsive tablaAdministradores" width="100%" id="TablaAdministradores">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tipo de plato</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <tr>
                                        <?php
                                        $mostrarTiposDeplato = new ControladorTipoDePlatos();
                                        $mostrarTiposDeplato->ctrMostrarTipodePlatos();
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


<!-- Para realizar la búsqueda de los tipos de plato-->
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


<!-- Para la venta modal de crear un nuevo tipo de plato -->

<div class="modal fade" id="crearTipoPlato" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="staticBackdropLabel">Crear nuevo tipo de plato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Input plato -->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fas fa-leaf"></span>
                        </div>
                        <input type="text" class="form-control" name="registroTipoPlato" placeholder="Ingresa el tipo de plato" required>
                    </div>
                </div>
                <!-- Para el registro de tipo de platos -->
                <?php
                $registroTipoPlato = new ControladorTipoDePlatos();
                $registroTipoPlato->ctrRegistroTipoDePlatos();
                ?>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>