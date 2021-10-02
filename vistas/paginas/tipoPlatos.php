<?php
$mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
if ($mysqli->connect_error) {
    die('Error en la conexión' . $mysqli->connect_error);
}
$sql = "SELECT * FROM tipos";
$resultado = $mysqli->query($sql);

?>
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
                            <table class="table table-bordered table-striped dt-responsive tablaTipodePlatos" width="100%">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Tipo de plato</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                    <?php
                                    while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                                        <tr>
                                            <td><?php echo $row['codTipo'] ?></td>
                                            <td><?php echo $row['descripcion'] ?></td>
                                            <td>

                                                <button class='btn btn-primary btn-sm'><a href="modificarTipoPlato.php?codPlato=<?php echo $row['codTipo']; ?>"><i class="far fa-edit text-white"></i></a></button>
                                                <button class='btn btn-danger btn-sm'><a href="#" data-href="eliminarTipoPlatos.php?codPlato=<?php echo $row['codTipo']; ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete"><i class="fas fa-trash-alt text-white"></i></a></button>
                                            </td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
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
<!-- Para la ventana modal de eliminar a las categorias -->
<div class="modal fade" tabindex="-1" id="confirm-delete" aria-labelledby="myModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog">
        <form action="eliminarCat.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminación de Registros</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Desea eliminar el registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger btn-ok">Eliminar</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('#confirm-delete').on('shown.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
</script>

<!-- Para la ventan modal de eliminar a los tipos de platos -->
<div class="modal fade" tabindex="-1" id="confirm-delete" aria-labelledby="myModalLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog">
        <form action="eliminarCat.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminación de Registros</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Desea eliminar el registro?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
                    <a class="btn btn-danger btn-ok">Eliminar</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('#confirm-delete').on('shown.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
</script>



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