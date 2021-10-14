<?php
require('fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../img/cooking_logo.png', 95, 20, 15);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 12);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 15, 'Restaurante Soon Marie', 0, 0, 'C');
        $this->Ln(20);

        $this->Cell(80);
        $this->Cell(30, 15, 'Reporte de los empleados', 0, 0, 'C');
        $this->Ln(10);

        $this->Cell(80);
        $this->Cell(30, 15, '"Un restaurante que fomenta las relaciones y alimenta los corazones"', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(18, 6, utf8_decode('Código'), 1, 0, 'C', 0);
        $this->Cell(38, 6, 'Cliente', 1, 0, 'C', 0);
        $this->Cell(20, 6, utf8_decode('Teléfono'), 1, 0, 'C', 0);
        $this->Cell(35, 6, utf8_decode('Dirección'), 1, 0, 'C', 0);
        $this->Cell(38, 6, 'Empleado', 1, 0, 'C', 0);
        $this->Cell(18, 6, utf8_decode('Turno'), 1, 0, 'C', 0);
        $this->Cell(30, 6, 'Horario', 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

require '../../conexion.php';
$consulta1 = "SELECT * FROM v_reservas";
$resultado1 = $mysqli->query($consulta1);


// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);
while ($mostrar = $resultado1->fetch_array(MYSQLI_ASSOC)) {
    $pdf->Cell(18, 6, $mostrar['codReserva'], 1, 0, 'L', 0);
    $pdf->Cell(38, 6, utf8_decode($mostrar['Cliente']), 1, 0, 'L', 0);
    $pdf->Cell(20, 6, $mostrar['TelefonoCliente'], 1, 0, 'L', 0);
    $pdf->Cell(35, 6, utf8_decode($mostrar['DireccionCliente']), 1, 0, 'C', 0);
    $pdf->Cell(38, 6, utf8_decode($mostrar['Empleado']), 1, 0, 'L', 0);
    $pdf->Cell(18, 6, $mostrar['descripcion'], 1, 0, 'C', 0);
    $pdf->Cell(30, 6, $mostrar['Horario'], 1, 1, 'L', 0);
}
$pdf->Output();
