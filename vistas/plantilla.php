<?php
session_start();
$rutaBackend = ControladorRuta::ctrRutaBackend();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="vistas/img/plantilla/cooking.svg" type="image/x-icon">
    <title>Restaurante Soon Marie</title>

    <!-- Vinculos CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="zmfNZmXoNWBMemUOo1XUGFfc0ihGGLYdgtJS3KCr/l0=">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="css/plugins/bootstrap-datepicker.standalone.min.css">

    <!-- jdSlider -->
    <link rel="stylesheet" href="css/plugins/jquery.jdSlider.css">

    <!-- Pano -->
    <link rel="stylesheet" href="css/plugins/jquery.pano.css">

    <!-- fullCalendar -->
    <link rel="stylesheet" href="css/plugins/fullcalendar.min.css">

    <!-- Theme style AdmninLTE -->
    <link rel="stylesheet" href="vistas/css/plugins/adminlte.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="vistas/css/plugins/responsive.bootstrap.min.css">
    <link rel="stylesheet" href="vistas/css/plugins/datatables.css">
    <link rel="stylesheet" href="vistas/css/plugins/datatables.min.css">



    <!-- Vinculos de JS -->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <!-- bootstrap datepicker -->
    <!-- https://bootstrap-datepicker.readthedocs.io/en/latest/ -->
    <script src="js/plugins/bootstrap-datepicker.min.js"></script>

    <!-- https://easings.net/es# -->
    <script src="js/plugins/jquery.easing.js"></script>

    <!-- https://markgoodyear.com/labs/scrollup/ -->
    <script src="js/plugins/scrollUP.js"></script>

    <!-- jdSlider -->
    <!-- https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
    <script src="js/plugins/jquery.jdSlider-latest.js"></script>

    <!-- Pano -->
    <!-- https://www.jqueryscript.net/other/360-Degree-Panoramic-Image-Viewer-with-jQuery-Pano.html -->
    <script src="js/plugins/jquery.pano.js"></script>

    <!-- https://momentjs.com/ -->
    <script src="js/plugins/moment.js"></script>

    <!-- AdminLTE App -->
    <script src="vistas/js/plugins/adminlte.min.js"></script>

    <!-- SWEET ALERT 2 -->
    <!-- https://sweetalert2.github.io/ -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Animate css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- DataTables -->
    <script src="vistas/js/plugins/dataTables.responsive.min.js"></script>
    <script src="vistas/js/plugins/responsive.bootstrap.min.js"></script> 
    <script src="vistas/js/plugins/datatables.js"></script>
    <script src="vistas/js/plugins/datatables.min.js"></script>

</head>

<!-- PARA QUE LOS USUARIOS INGRESEN AL SISTEMA -->
<?php if (!isset($_SESSION["validarSesionBackend"])) :
    include "paginas/login.php";
?>
<?php else : ?>

    <body class="hold-transition sidebar-mini sidebar-collapse">
        <div class="wrapper">
            <?php
            include "paginas/modulos/header.php";
            include "paginas/modulos/menu.php";

            /* Navegación de páginas */
            if (isset($_GET["pagina"])) {

                if (
                    $_GET["pagina"] == "inicio" ||
                    $_GET["pagina"] == "administradores" ||
                    $_GET["pagina"] == "categorias" ||
                    $_GET["pagina"] == "clientes" ||
                    $_GET["pagina"] == "detallereservas" ||
                    $_GET["pagina"] == "especialidades" ||
                    $_GET["pagina"] == "platos" ||
                    $_GET["pagina"] == "reservas" ||
                    $_GET["pagina"] == "tipoPlatos" ||
                    $_GET["pagina"] == "turno" ||
                    $_GET["pagina"] == "guardar" ||
                    $_GET["pagina"] == "salir"

                ) {

                    include "paginas/" . $_GET["pagina"] . ".php";
                } else {

                    include "paginas/error404.php";
                    include "paginas/modificar.php";
                }
            } else {

                include "paginas/inicio.php";
            }
            include "paginas/modulos/footer.php";
            ?>
        </div>
        <script src="vistas/js/administradores.js"></script>
        <script src="vistas/js/categorias.js"></script>
        <script src="vistas/js/tablaTipodePlatos.js"></script>
    </body>
<?php endif ?>

</html>