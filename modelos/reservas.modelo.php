<?php
class ModeloReservas
{
    /* para mostrar los turnos */
    static public function mdlMostrarTurnos($mysqli, $tabla)
    {
        $sql = "SELECT * FROM $tabla";
        $respuesta = $mysqli->query($sql);
        if ($respuesta) {
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                if ($row['capacidad'] > 0) {
                    echo "<option value='" . $row['idTurnos'] . "'>" . $row['descripcion'] . ' de ' . $row['inicio'] . ' a ' . $row['fin'] . ' | Disponible: ' . $row['capacidad'] . "</option>";
                }
            }
        } else {
            echo "sin turnos disponibles";
        }
    }

    /* para mostrar los turnos */
    static public function mdlMostrarPlatos($mysqli, $tabla)
    {
        $sql = "SELECT * FROM $tabla";
        $respuesta = $mysqli->query($sql);
        if ($respuesta) {
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                echo "<option value='" . $row['codPlato'] . "'>" . $row['nombrePlato'] . "</option>";
            }
        } else {
            echo "sin turnos disponibles";
        }
    }

    /* para mostrar los empleados disponibles para atender */
    static public function mdlMostrarEmpleados($mysqli, $tabla)
    {
        $sql = "SELECT * FROM $tabla ";
        $respuesta = $mysqli->query($sql);
        if ($respuesta) {
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                echo "<option value='" . $row['DNI'] . "'>" . $row['usuario'] . "</option>";
            }
        } else {
            echo "sin empleados disponibles";
        }
    }



    /* Para registrar las reservas nuevas */

    /*Registro de Administradores*/
    static public function mdlRegistroReservas($mysqli, $sql)
    {
        $respuesta = $mysqli->query($sql);

        if ($respuesta) {
            return "ok";
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['codReserva'] . "</td>";
                echo "<td>" . $row['Cliente'] . "</td>";
                echo "<td>" . $row['TelefonoCliente'] . "</td>";
                echo "<td>" . $row['DireccionCliente'] . "</td>";
                echo "<td>" . $row['Empleado'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<td>" . $row['Horario'] . "</td>";
                echo "<td>" . "<button class='btn btn-success btn-sm'>Activo</button></td>" . "</td>";
                echo "<td>" . "<button class='btn btn-primary btn-sm'><i class='fas fa-pencil-alt text-white'></i></button>" . "<button class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button>" . "</td>";
                echo "</tr>";
            }
        } else {
            echo "ERROR, NO S EPUDO MOSTRar la tabla";
        }

        echo $respuesta;
    }
}
