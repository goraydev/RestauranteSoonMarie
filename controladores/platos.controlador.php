<?php
class ControladorPlatos
{
    public function ctrRegistroPlatos()
    {
        if (isset($_POST["registroPlato"])) {
            if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["registroPlato"])) {
                $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
                if ($mysqli->connect_error) {
                    die('Error en la conexión' . $mysqli->connect_error);
                }
                $nombrePlato = $_POST["registroPlato"];
                $precioPlato = $_POST["precioPlato"];
                $registroEspecialidad = $_POST["registroEspecialidad"];
                $registroTipoPlato = $_POST["registroTipoPlato"];

                $sql = "CALL p_nuevoPlato('$nombrePlato','$precioPlato','$registroEspecialidad','$registroTipoPlato')";
                $respuesta = ModeloPlatos::mdlRegistroPlatos($mysqli, $sql);
                if ($respuesta == "ok") {

                    echo '<script>

						Swal.fire({
								icon:"success",
							  	title: "¡CORRECTO!",
							  	text: "El plato ha sido creado correctamente",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    window.location = "platos";
								  } 
						});

					</script>';
                }
            } else {
                echo "<div class='alert alert-danger mt-3 small'>Error: No se permiten caracteres especiales </div>";
            }
        }
    }

    /* Para mostrar las especialidades */
    public function ctrMostrarEspecialidades()
    {
        $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
        if ($mysqli->connect_error) {
            die('Error en la conexión' . $mysqli->connect_error);
        }
        $tabla = "especialidades";
        $respuesta = ModeloPlatos::mdlMostrarEspecialidades($mysqli, $tabla);

        return $respuesta;
    }

    /* Para mostrar las especialidades */
    public function ctrMostrarTipoPlatos()
    {
        $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
        if ($mysqli->connect_error) {
            die('Error en la conexión' . $mysqli->connect_error);
        }
        $tabla = "tipos";
        $respuesta = ModeloPlatos::mdlMostrarTipoPlatos($mysqli, $tabla);

        return $respuesta;
    }
}
