<?php

class ControladorEspecialidades
{
    public function ctrMostrarEspecialidades()
    {
        $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
        if ($mysqli->connect_error) {
            die('Error en la conexión' . $mysqli->connect_error);
        }
        $tabla = "especialidades";
        $respuesta = ModeloEspecialidades::mdlMostrarTablaEspecialidad($mysqli, $tabla);

        return $respuesta;
    }
    public function ctrRegistroEspecialidad()
    {
        if (isset($_POST["registroEspecialidad"])) {
            if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["registroEspecialidad"])) {
                $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
                if ($mysqli->connect_error) {
                    die('Error en la conexión' . $mysqli->connect_error);
                }

                $especialidad = $_POST["registroEspecialidad"];
                $sql = "CALL p_nuevaEspecialidad('$especialidad')";
                $respuesta = ModeloEspecialidades::mdlRegistroEspecialidad($mysqli, $sql);
                if ($respuesta == "ok") {

                    echo '<script>

						Swal.fire({
								icon:"success",
							  	title: "¡CORRECTO!",
							  	text: "La especialidad ha sido creado correctamente",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    window.location = "especialidades";
								  } 
						});

					</script>';
                }
            } else {
                echo "<div class='alert alert-danger mt-3 small'>Error: No se permiten caracteres especiales </div>";
            }
        }
    }
}
