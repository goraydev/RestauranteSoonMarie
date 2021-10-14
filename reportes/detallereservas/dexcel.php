<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=detallereservas.xls");
?>
<?php
require '../../conexion.php';
$sql = "SELECT * FROM v_reservageneral";
$resultado = $mysqli->query($sql);

?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Cliente</th>
			<th>Telefono</th>
			<th>Direccion</th>
			<th>Plato</th>
			<th>Precio</th>
			<th>Comensales</th>
			<th>Pago</th>
			<th>Fecha llamada</th>
			<th>Fecha reserva</th>
			<th>Turno</th>
			<th>Horario</th>
			<th>Empleado</th>
		</tr>
	</thead>

	<tbody>
		<?php while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
			<tr>
				<td><?php echo $row['codReserva']; ?></td>
				<td><?php echo utf8_decode($row['Cliente']); ?></td>
				<td><?php echo $row['telCliente']; ?></td>
				<td><?php echo utf8_decode($row['dirCliente']); ?></td>
				<td><?php echo utf8_decode($row['nombrePlato']); ?></td>
				<td><?php echo $row['precioUnidad']; ?></td>
				<td><?php echo $row['numComensales']; ?></td>
				<td><?php echo $row['precioPagar']; ?></td>
				<td><?php echo $row['fecha_llamada']; ?></td>
				<td><?php echo $row['fecha_reserva']; ?></td>
				<td><?php echo $row['descripcion']; ?></td>
				<td><?php echo $row['Horario']; ?></td>
				<td><?php echo utf8_decode($row['Empleado']); ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>