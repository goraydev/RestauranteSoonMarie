<?php
class ModeloEspecialidades
{
    static public function mdlMostrarTablaEspecialidad($mysqli, $tabla)
    {
        $sql = "SELECT * FROM $tabla";
        $respuesta = $mysqli->query($sql);
        if ($respuesta) {
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['codEspecialidad'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<td>" . "<button class='btn btn-primary btn-sm'><i class='fas fa-pencil-alt text-white'></i></button>" . "<button class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button>" . "</td>";
                echo "</tr>";
            }
        } else {
            echo "ERROR, NO S EPUDO MOSTRar la tabla";
        }
    }
    static public function mdlRegistroEspecialidad($mysqli, $sql)
    {
        $respuesta = $mysqli->query($sql);
        if ($respuesta) {
            return "ok";
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['codEspecialidad'] . "</td>";
                echo "<td>" . $row['descripcion'] . "</td>";
                echo "<td>" . "<button class='btn btn-primary btn-sm'><i class='fas fa-pencil-alt text-white'></i></button>" . "<button class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button>" . "</td>";
                echo "</tr>";
            }
        } else {
            echo "ERROR, NO S EPUDO MOSTRar la tabla";
        }
    }
}
