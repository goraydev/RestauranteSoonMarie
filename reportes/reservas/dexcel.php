<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reservas.xls");
?>
<?php
require '../../conexion.php';
$sql = "SELECT * FROM v_reservas";
$resultado = $mysqli->query($sql);

?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Cliente</th>
			<th>Telefono</th>
			<th>Direccion</th>
			<th>Empleado</th>
			<th>Descripcion</th>
			<th>Horario</th>
		</tr>
	</thead>

	<tbody>
		<?php while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
			<tr>
				<td><?php echo $row['codReserva']; ?></td>
				<td><?php echo utf8_decode($row['Cliente']); ?></td>
				<td><?php echo $row['TelefonoCliente']; ?></td>
				<td><?php echo utf8_decode($row['DireccionCliente']); ?></td>
				<td><?php echo utf8_decode($row['Empleado']); ?></td>
				<td><?php echo $row['descripcion']; ?></td>
				<td><?php echo $row['Horario']; ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>