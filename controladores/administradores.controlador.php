<?php
class ControladorAdministradores
{
    /* Para ingresar al sistema */

    public function ctrIngresoAdministradores()
    {
        if (isset($_POST["ingresoUsuario"])) {
            /* Para aceptar caracteres de tipo letra y número y no recibir inyecciones sql */
            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoUsuario"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoPassword"])) {
                $tabla = "cuentas";
                $item = "usuario";
                $valor =  $_POST["ingresoUsuario"];
                $respuesta = ModeloAdministradores::mdlMostrarAdministradores($tabla, $item, $valor);
                if ($respuesta["usuario"] == $_POST["ingresoUsuario"] && $respuesta["password"] == $_POST["ingresoPassword"]) {
                    $_SESSION["validarSesionBackend"] = "ok";
                    $_SESSION["idBackend"] = $respuesta["idCuenta"];
                    echo '<script>

					 	window.location = "' . $_SERVER["REQUEST_URI"] . '";

				  		</script>';
                } else {
                    echo "<div class='alert alert-danger mt-3 small'>Usuario o contraseña incorrecto</div>";
                }
            } else {
                echo "<div class='alert alert-danger mt-3 small'>Error: No se permiten caracteres especiales </div>";
            }
        }
    }

    /* Mostrar administradores */
    static public function ctrMostrarAdministradores()
    {
        $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
        if ($mysqli->connect_error) {
            die('Error en la conexión' . $mysqli->connect_error);
        }
        $tabla = "v_empleados";
        $respuesta = ModeloAdministradores::mdlMostrarTabla($mysqli, $tabla);

        return $respuesta;
    }

    /* Para registrar a los administradores */
    public function ctrRegistroAdministrador()
    {
        if (isset($_POST["registroDNI"])) {
            if (preg_match('/^[0-9]+$/', $_POST["registroDNI"]) && preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["registroNombre"])) {
                $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
                if ($mysqli->connect_error) {
                    die('Error en la conexión' . $mysqli->connect_error);
                }

                $dni = $_POST['registroDNI'];
                $nombre = $_POST['registroNombre'];
                $apellPat = $_POST['registroApellidoPat'];
                $apellMat = $_POST['registroApellidoMat'];
                $numTelefono  = $_POST['registroNumTelefono'];
                $direccion = $_POST['registroDireccion'];
                $password = $_POST['registroPassword'];
                $categoria = $_POST['registroCategoria'];

                echo $dni;

                $sql = "CALL p_nuevoRegisEmp('$dni','$nombre','$apellPat','$apellMat','$numTelefono','$direccion','$password','0','$categoria')";

                $respuesta = ModeloAdministradores::mdlRegistroAdministradores($mysqli, $sql);
                if ($respuesta == "ok") {

                    echo '<script>

						Swal.fire({
								icon:"success",
							  	title: "¡CORRECTO!",
							  	text: "El empleado ha sido creado correctamente",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    window.location = "administradores";
								  } 
						});

					</script>';
                }
            } else {
                echo "<div class='alert alert-danger mt-3 small'>Error: No se permiten caracteres especiales </div>";
            }
        }
    }

    /* Para la seleccion de categoria */
    public function ctrMostrarOpciones()
    {
        $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
        if ($mysqli->connect_error) {
            die('Error en la conexión' . $mysqli->connect_error);
        }
        $tabla = "categorias";
        $respuesta = ModeloAdministradores::mdlMostrarOpciones($mysqli, $tabla);

        return $respuesta;
    }

    public function ctrBusquedaAdministrador()
    {
        $mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
        if ($mysqli->connect_error) {
            die('Error en la conexión' . $mysqli->connect_error);
        }
        $tabla = "v_empleados";
        if (isset($_POST["campo"])) {
            $campo = $_POST["campo"];
            $respuesta = ModeloAdministradores::mdlMostrarBusqueda($mysqli, $tabla, $campo);
            return $respuesta;
        }
    }
}
