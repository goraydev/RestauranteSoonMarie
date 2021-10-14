<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=empleados.xls");
?>
<?php
require '../../conexion.php';
$sql = "SELECT * FROM v_empleados";
$resultado = $mysqli->query($sql);

?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>DNI</th>
			<th>Empleado</th>
			<th>Telefono</th>
			<th>Direccion</th>
			<th>Categoria</th>
		</tr>
	</thead>

	<tbody>
		<?php while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
			<tr>
				<td><?php echo $row['DNI']; ?></td>
				<td><?php echo utf8_decode($row['Empleado']); ?></td>
				<td><?php echo $row['numTelefono']; ?></td>
				<td><?php echo utf8_decode($row['direccion']); ?></td>
				<td><?php echo utf8_decode($row['categoria']); ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>