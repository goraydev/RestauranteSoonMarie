<?php
class ControladorInicio
{
    /* Sumamos toda la columna de pago del detalle reservas */
    static public function ctrSumarVentas()
    {

        $tabla = "detallereservas";

        $respuesta = ModeloInicio::mdlSumarVentas($tabla);

        return $respuesta;
    }

    /* Mostramos la cantidad de reservas quee hay */
    static public function ctrMostrarReservas()
    {

        $tabla = "reservas";

        $respuesta = ModeloInicio::mdlMostrarReservas($tabla);

        return $respuesta;
    }
    /* Mostramos la cantidad de reservas quee hay */
    static public function ctrMostrarPlatos()
    {

        $tabla = "platos";

        $respuesta = ModeloInicio::mdlMostrarPlatos($tabla);

        return $respuesta;
    }

    /* Mostramos la cantidad de reservas quee hay */
    static public function ctrMostrarEmpleados()
    {

        $tabla = "empleados";

        $respuesta = ModeloInicio::mdlMostrarEmpleados($tabla);

        return $respuesta;
    }

    /* Mostramos la cantidad de reservas quee hay */
    static public function ctrMostrarDetalleReservas()
    {

        $tabla = "detallereservas";

        $respuesta = ModeloInicio::mdlMostrarDetalleReservas($tabla);

        return $respuesta;
    }
}
