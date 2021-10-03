<?php
require_once "conexion.php";
class ModeloPlatos
{
    static function mdlRegistroPlatos($mysqli, $sql)
    {
        $respuesta = $mysqli->query($sql);
        if ($respuesta) {
            return "ok";
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['codPlato'] . "</td>";
                echo "<td>" . $row['nombrePlato'] . "</td>";
                echo "<td>" . $row['precio'] . "</td>";
                echo "<td>" . $row['fk_codEspecialidad'] . "</td>";
                echo "<td>" . $row['fk_codTipo'] . "</td>";
                echo "<td>" . "<button class='btn btn-primary btn-sm'><i class='fas fa-pencil-alt text-white'></i></button>" . "<button class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button>" . "</td>";
                echo "</tr>";
            }
        } else {
            echo "ERROR, NO S EPUDO MOSTRar la tabla";
        }
    }


    static public function mdlMostrarEspecialidades($mysqli, $tabla)
    {
        $sql = "SELECT * FROM $tabla";
        $respuesta = $mysqli->query($sql);
        if ($respuesta) {
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                echo "<option value='" . $row['codEspecialidad'] . "'>" . $row['descripcion'] . "</option>";
            }
        } else {
            echo "sin especialidades";
        }
    }

    static public function mdlMostrarTipoPlatos($mysqli, $tabla)
    {
        $sql = "SELECT * FROM $tabla";
        $respuesta = $mysqli->query($sql);
        if ($respuesta) {
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                echo "<option value='" . $row['codTipo'] . "'>" . $row['descripcion'] . "</option>";
            }
        } else {
            echo "sin tipos";
        }
    }
}
