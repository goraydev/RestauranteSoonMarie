<div class="content-wrapper" style="min-height: 1761.5px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestor de categorias</h1>
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
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#crearCategoria">
                                Nuevo registro
                            </button>
                            <br><br>
                            <label for="myInput">Buscar categoria</label>
                            <input class="form-control" id="myInput" type="text" placeholder="Ingrese dato">
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped dt-responsive tablaCategorias" width="100%">

                                <thead>

                                    <tr>
                                        <th>Código</th>
                                        <th>Categoria</th>
                                        <th>Acciones</th>

                                    </tr>

                                </thead>

                                <tbody id="myTable">
                                    <?php
                                    $mostrarCategorias = new ControladorCategorias();
                                    $mostrarCategorias->ctrMostrarCategorias();
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

<!-- Para realizar la búsqueda de las categorias -->
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


<!-- Para crear una nueva categoria -->
<div class="modal fade" id="crearCategoria" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="staticBackdropLabel">Crear nueva categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Input categoria-->
                    <div class="input-group mb-3">
                        <div class="input-group-append input-group-text">
                            <span class="fas fa-users-cog"></span>
                        </div>
                        <input type="text" class="form-control" name="registroCategoria" placeholder="Ingresa categoria" required>
                    </div>

                </div>
                <?php
                $registroCategoria = new ControladorCategorias();
                $registroCategoria->ctrRegistroCategoria();
                ?>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>