<?php
class ControladorTipoDePlatos
{
    /* Para mostrar los datos de la tabla Tipos */
    public function ctrMostrarTipodePlatos()
    {
        $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
        if ($mysqli->connect_error) {
            die('Error en la conexión' . $mysqli->connect_error);
        }
        $tabla = "tipos";
        $respuesta = ModeloTipoDePlatos::mdlMostrarTablaTipos($mysqli, $tabla);

        return $respuesta;
    }
    /* Para registrar los tipos de platos */
    public function ctrRegistroTipoDePlatos()
    {
        if (isset($_POST["registroTipoPlato"])) {
            if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["registroTipoPlato"])) {
                $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
                if ($mysqli->connect_error) {
                    die('Error en la conexión' . $mysqli->connect_error);
                }
                $tabla = "tipos";
                $tipoDePlato = $_POST["registroTipoPlato"];
                $respuesta = ModeloTipoDePlatos::mdlRegistroTipoDePlato($mysqli, $tabla, $tipoDePlato);
                if ($respuesta == "ok") {

                    echo '<script>

						Swal.fire({
								icon:"success",
							  	title: "¡CORRECTO!",
							  	text: "El tipo de plato ha sido creado correctamente",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    window.location = "tipoPlatos";
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
