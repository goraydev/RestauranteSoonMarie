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
    static public function ctrMostrarAdministradores($item,$valor){
        $tabla="v_empleados";
        $respuesta=ModeloAdministradores::mdlMostrarAdministradores($tabla,$item,$valor);
        return $respuesta;
    }
}
