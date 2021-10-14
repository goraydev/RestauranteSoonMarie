<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=clientes.xls");
?>
<?php
require '../conexion.php';
$sql = "SELECT * FROM v_clientes";
$resultado = $mysqli->query($sql);

?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Clientes</th>
			<th>Teléfono</th>
			<th>Dirección</th>
		</tr>
	</thead>

	<tbody>
		<?php while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
			<tr>
				<td><?php echo utf8_decode($row['codCliente']); ?></td>
				<td><?php echo utf8_decode($row['Cliente']); ?></td>
				<td><?php echo $row['numTelefono']; ?></td>
				<td><?php echo utf8_decode($row['direccion']); ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>