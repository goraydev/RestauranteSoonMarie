<?php
require_once "conexion.php";
class ModeloInicio
{
    /* Sumamos el precio a pagar de las reservas */
    static public function mdlSumarVentas($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT SUM(precioPagar) as total FROM $tabla");

        $stmt->execute();

        return $stmt->fetch();

        $stmt = null;
    }

    /* Mostramos la cantidad de reservas que hay */
    static public function mdlMostrarReservas($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as totalReservas FROM $tabla");

        $stmt->execute();

        return $stmt->fetch();

        $stmt = null;
    }

    /* Mostramos la cantidad de reservas que hay */
    static public function mdlMostrarDetalleReservas($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $tabla.fecha_reserva ASC");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    /* Mostramos la cantidad de platos que hay */
    static public function mdlMostrarPlatos($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as totalPlatos FROM $tabla");

        $stmt->execute();

        return $stmt->fetch();

        $stmt = null;
    }

    /* Mostramos la cantidad de empleados que hay */
    static public function mdlMostrarEmpleados($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as totalEmpleados FROM $tabla");

        $stmt->execute();

        return $stmt->fetch();

        $stmt = null;
    }
}
