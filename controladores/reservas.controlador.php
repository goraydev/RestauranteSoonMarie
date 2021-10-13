<?php
class ControladorReservas
{
    public function ctrRegistroReserva()
    {
        if (isset($_POST["registroNombre"])) {
            if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["registroNombre"]) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["registroApellidoPat"]) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["registroApellidoMat"])) {
                $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
                if ($mysqli->connect_error) {
                    die('Error en la conexión' . $mysqli->connect_error);
                }
                $nombre = $_POST['registroNombre'];
                $apellPat = $_POST['registroApellidoPat'];
                $apellMat = $_POST['registroApellidoMat'];
                $numTelefono  = $_POST['registroNumTelefono'];
                $direccion = $_POST['registroDireccion'];

                /* Para pasar el DNI DEL empleado que ingreso al sistema */
                $registroUsuario = $_POST['registroEmpleado'];

                $numComensales = $_POST['registroNumeroComensales'];
                $registroTurno = $_POST['registroTurno'];
                $fechaReserva = $_POST['fechaReserva'];
                $registroPlato = $_POST['registroPlato'];


                $sql = "CALL p_nuevoRegisClie('$nombre','$apellPat','$apellMat','$numTelefono','$direccion','$registroUsuario','$numComensales','$registroTurno','$fechaReserva','$registroPlato')";
                $respuesta = ModeloReservas::mdlRegistroReservas($mysqli, $sql);
                if ($respuesta == "ok") {

                    echo '<script>

						Swal.fire({
								icon:"success",
							  	title: "¡CORRECTO!",
							  	text: "Reserva exitosa",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    window.location = "reservas";
								  } 
						});

					</script>';
                }
            } else {
                echo "<div class='alert alert-danger mt-3 small'>Error: No se permiten caracteres especiales </div>";
            }
        }
    }

    /* Para que se muestres los turnos disponibles */
    public function ctrMostrarTurnos()
    {
        $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
        if ($mysqli->connect_error) {
            die('Error en la conexión' . $mysqli->connect_error);
        }
        $tabla = "turnos";
        $respuesta = ModeloReservas::mdlMostrarTurnos($mysqli, $tabla);

        return $respuesta;
    }

    /* Para que se muestres los turnos disponibles */
    public function ctrMostrarPlatos()
    {
        $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
        if ($mysqli->connect_error) {
            die('Error en la conexión' . $mysqli->connect_error);
        }
        $tabla = "platos";
        $respuesta = ModeloReservas::mdlMostrarPlatos($mysqli, $tabla);

        return $respuesta;
    }
}
