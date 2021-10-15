<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reservascanceladas.xls");
?>
<?php
require '../../conexion.php';
$sql = "SELECT * FROM t_detallereservas WHERE Accion = 'DELETE'";
$resultado = $mysqli->query($sql);

?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Plato</th>
			<th>Pago</th>
			<th>Llamada</th>
			<th>Reservada</th>
			<th>Cancelada</th>
		</tr>
	</thead>

	<tbody>
		<?php while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
			<tr>
				<td><?php echo $row['fk_reserva']; ?></td>
				<td><?php echo utf8_decode($row['fk_plato_old']); ?></td>
				<td><?php echo $row['fk_pago_old']; ?></td>
				<td><?php echo $row['fecha_llamada_old']; ?></td>
				<td><?php echo $row['fecha_reserva_old']; ?></td>
				<td><?php echo $row['Fecha_accion']; ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>