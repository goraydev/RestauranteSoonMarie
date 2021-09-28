<?php

require_once "conexion.php";

class ModeloAdministradores
{
    /* Mostramos los administradores */
    static public function mdlMostrarAdministradores($tabla, $item, $valor)
    {
        if ($item != null && $valor != null) {
            /* $item es el nombre de mi columna usuario de mi tabla cuentas y 
            con $stmt almacenamos la búsqueda*/
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    static public function mdlMostrarTabla($mysqli, $tabla)
    {
        $sql = "SELECT * FROM $tabla";
        $respuesta = $mysqli->query($sql);
        if ($respuesta) {
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['DNI'] . "</td>";
                echo "<td>" . $row['Empleado'] . "</td>";
                echo "<td>" . $row['usuario'] . "</td>";
                echo "<td>" . $row['categoria'] . "</td>";
                echo "<td>" . "<button class='btn btn-success btn-sm'>Activo</button></td>" . "</td>";
                echo "<td>" . "<button class='btn btn-primary btn-sm'><i class='fas fa-pencil-alt text-white'></i></button>" . "<button class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button>" . "</td>";
                echo "</tr>";
            }
        } else {
            echo "ERROR, NO S EPUDO MOSTRar la tabla";
        }
    }
    static public function mdlMostrarOpciones($mysqli, $tabla)
    {
        $sql = "SELECT * FROM $tabla";
        $respuesta = $mysqli->query($sql);
        if ($respuesta) {
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                echo "<option value='" . $row['codCategoria'] . "'>" . $row['categoria'] . "</option>";
            }
        } else {
            echo "sin categorias";
        }
    }
    static public function mdlMostrarBusqueda($mysqli, $tabla, $campo)
    {
        $sql = "CALL p_busquedaEmpleado('$campo');";
        $respuesta = $mysqli->query($sql);
        if ($respuesta) {
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['DNI'] . "</td>";
                echo "<td>" . $row['Empleado'] . "</td>";
                echo "<td>" . $row['usuario'] . "</td>";
                echo "<td>" . $row['categoria'] . "</td>";
                echo "<td>" . "<button class='btn btn-success btn-sm'>Activo</button></td>" . "</td>";
                echo "<td>" . "<button class='btn btn-warning btn-sm'><i class='fas fa-pencil-alt text-white'></i></button>" . "<button class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button>" . "</td>";
                echo "</tr>";
            }
        } else {
            echo "ERROR, NO S EPUDO MOSTRar la tabla";
        }
    }


    /*Registro de Administradores*/
    static public function mdlRegistroAdministradores($mysqli, $sql)
    {
        $respuesta = $mysqli->query($sql);

        if ($respuesta) {
            return "ok";
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['DNI'] . "</td>";
                echo "<td>" . $row['Empleado'] . "</td>";
                echo "<td>" . $row['usuario'] . "</td>";
                echo "<td>" . $row['categoria'] . "</td>";
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
