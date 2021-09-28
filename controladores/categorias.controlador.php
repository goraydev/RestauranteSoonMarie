<?php
class ControladorCategorias
{
    /* Pa mastrar las categorias */
    static public function ctrMostrarCategorias()
    {

        $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
        if ($mysqli->connect_error) {
            die('Error en la conexión' . $mysqli->connect_error);
        }
        $tabla = "categorias";

        $respuesta = ModeloCategorias::mdlMostrarTablaCategorias($mysqli, $tabla);

        return $respuesta;
    }

    /* Para registar a la nueva categoria */
    public function ctrRegistroCategoria()
    {
        if (isset($_POST["registroCategoria"])) {
            if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["registroCategoria"])) {
                $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
                if ($mysqli->connect_error) {
                    die('Error en la conexión' . $mysqli->connect_error);
                }
                $categoria = $_POST["registroCategoria"];
                $sql = "CALL p_nuevaCategoria('$categoria')";

                $respuesta = ModeloCategorias::mdlRegistroCategorias($mysqli, $sql);
                if ($respuesta == "ok") {

                    echo '<script>

						Swal.fire({
								icon:"success",
							  	title: "¡CORRECTO!",
							  	text: "Categoria creada con éxito",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    window.location = "categorias";
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
