<aside class="main-sidebar sidebar-dark-warning elevation-4">
    <!-- Logo -->
    <a href="index.php" class="brand-link">
        <img src="vistas/img/plantilla/tenedor.svg" alt="tipificación unasam" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SOON MARIE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <?php if ($admin["fk_codCategoria"] == "CEM-GER") : ?>
                    <li class="nav-item">
                        <a href="inicio" class="nav-link active">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Inicio
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="administradores" class="nav-link">
                            <i class="nav-icon fas fa-id-card"></i>
                            <p>
                                Empleados
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="categorias" class="nav-link">
                            <i class="nav-icon fas fas fa-users-cog"></i>
                            <p>
                                Categorias
                            </p>
                        </a>
                    </li>
                <?php endif ?>

                <li class="nav-item">
                    <a href="tipoPlatos" class="nav-link">
                        <i class="nav-icon fas fa-leaf"></i>
                        <p>
                            Tipo de platos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="especialidades" class="nav-link">
                        <i class="nav-icon fas fa-medal"></i>
                        <p>

                            Especialidades
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="platos" class="nav-link">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>
                            Platos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="turno" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            Turnos
                        </p>
                    </a>
                </li>
                <?php if (($admin["fk_codCategoria"] == "CEM-EMP") || ($admin["fk_codCategoria"] == "CEM-GER")) : ?>
                    <li class="nav-item">
                        <a href="reservas" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Reservas
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="detallereservas" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-check"></i>
                            <p>
                                Detalle de las reservas
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="clientes" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Clientes
                            </p>
                        </a>
                    </li>
                <?php endif ?>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>