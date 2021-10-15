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
        $this->Cell(30, 15, '"Un restaurante que fomenta las relaciones y alimenta los corazones"', 0, 0, 'C');
        $this->Ln(10);

        $this->Cell(80);
        $this->Cell(30, 15, 'Reporte de las reservas canceladas', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(20, 6, utf8_decode('Código'), 1, 0, 'C', 0);
        $this->Cell(35, 6, 'Plato', 1, 0, 'C', 0);
        $this->Cell(20, 6, utf8_decode('Pago'), 1, 0, 'C', 0);
        $this->Cell(35, 6, utf8_decode('Llamada'), 1, 0, 'C', 0);
        $this->Cell(35, 6, utf8_decode('Reservada'), 1, 0, 'C', 0);
        $this->Cell(35, 6, utf8_decode('Cancelada'), 1, 1, 'C', 0);
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
$consulta1 = "SELECT * FROM t_detallereservas WHERE Accion = 'DELETE'";
$resultado1 = $mysqli->query($consulta1);


// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 8);
while ($mostrar = $resultado1->fetch_array(MYSQLI_ASSOC)) {
    $pdf->Cell(20, 6, $mostrar['fk_reserva'], 1, 0, 'C', 0);
    $pdf->Cell(35, 6, utf8_decode($mostrar['fk_plato_old']), 1, 0, 'C', 0);
    $pdf->Cell(20, 6, $mostrar['fk_pago_old'], 1, 0, 'C', 0);
    $pdf->Cell(35, 6, $mostrar['fecha_llamada_old'], 1, 0, 'C', 0);
    $pdf->Cell(35, 6, $mostrar['fecha_reserva_old'], 1, 0, 'C', 0);
    $pdf->Cell(35, 6, $mostrar['Fecha_accion'], 1, 1, 'C', 0);
}
$pdf->Output();
