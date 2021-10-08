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
                echo "<td>" . "<button class='btn btn-danger btn-sm'>";
                echo "<a data-href='eliminarAdmin.php?DNI=";
                echo  $row['DNI'];
                echo "'>";
                echo "<i class='fas fa-trash-alt text-white'></i>" . "</a>" . "</button>";
            }
        } else {
            echo "ERROR, NO S EPUDO MOSTRar la tabla";
        }
    }

    static public function mdlMostrarIngreso($mysqli, $tabla, $usuario, $valor)
    {
        $sql = "SELECT $usuario FROM $tabla WHERE idCuenta = '$valor'";


        $respuesta = $mysqli->query($sql);
        if ($respuesta) {
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                echo $row['usuario'];
            }
        } else {
            echo "ERROR, NO S EPUDO MOSTRar la tabla";
        }
    }

    /* Para mostrar el DNI del empleados */
    static public function mdlMostrarDNIEmpleado($mysqli, $tabla, $usuario, $valor)
    {
        $sql = "SELECT $usuario FROM $tabla WHERE idCuenta = '$valor'";
        $respuesta = $mysqli->query($sql);
        if ($respuesta) {
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                echo $row['usuario'];
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
    /* Editar administrador */
    static public function mdlEditarAdministradores($mysqli, $tabla, $dni)
    {
        $sql = "SELECT * FROM $tabla WHERE DNI = '$dni'";
        $respuesta = $mysqli->query($sql);
        $row = $respuesta->fetch_array(MYSQLI_ASSOC);
        if ($respuesta) {
            return "ok";
            while ($row = $respuesta->fetch_array(MYSQLI_ASSOC)) {
                echo "<input type='text' class='form-control' name='editarfkPersona' value" . $row['fk_persona'] . "required>";
                echo "<input type='text' class='form-control' name='editarfkCuenta' value" . $row['fk_idCuenta'] . "required>";
            }
        }
    }
}
