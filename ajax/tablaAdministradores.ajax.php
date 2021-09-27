<?php
require_once "../controladores/administradores.controlador.php";
require_once "../modelos/administradores.modelo.php";

class TablaAdmin
{

    /*=============================================
	Tabla Administradores
	=============================================*/

    public function mostrarTabla()
    {

        $respuesta = ControladorAdministradores::ctrMostrarAdministradores(null, null);
        if (count($respuesta) == 0) {

            $datosJson = '{"data":[]}';

            echo $datosJson;

            return;
        }

        $datosJson = '{
	
		"data":[';

        foreach ($respuesta as $key => $value) {

            if ($value["DNI"] != 75182627) { /* Evitamos que el administrador principal se vaya a desactivar */

                if ($value["estado"] == 0) {

                    $estado = "<button class='btn btn-secondary btn-sm btnActivar' estadoAdmin='1' idAdmin='" . $value["id"] . "'>Desactivado</button>";
                } else {

                    $estado = "<button class='btn btn-success btn-sm btnActivar' estadoAdmin='0' idAdmin='" . $value["id"] . "'>Activado</button>";
                }
            } else {

                $estado = "<button class='btn btn-success btn-sm'>Activado</button>";
            }



            $acciones = "<div class='btn-group'><button class='btn btn-primary btn-sm editarAdministrador' data-toggle='modal' data-target='#editarAdministrador' idAdministrador='" . $value["DNI"] . "'><i class='fas fa-pencil-alt text-white'></i></button><button class='btn btn-danger btn-sm eliminarAdministrador' idAdministrador='" . $value["DNI"] . "'><i class='fas fa-trash-alt'></i></button></div>";

            $datosJson .= '[
				      "' . ($key + 1) . '",
                      "' . $value["DNI"] . '",
				      "' . $value["Empleado"] . '",
				      "' . $value["usuario"] . '",
				      "' . $value["categoria"] . '",
				      "' . $estado . '",
				      "' . $acciones . '"
				    ],';
        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .= ']}';


        echo $datosJson;
    }
}

/*=============================================
Tabla Administradores
=============================================*/

$tabla = new TablaAdmin();
$tabla->mostrarTabla();
