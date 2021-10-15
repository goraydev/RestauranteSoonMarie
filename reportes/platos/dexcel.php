<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=platos.xls");
?>
<?php
require '../../conexion.php';
$sql = "SELECT * FROM v_platos";
$resultado = $mysqli->query($sql);

?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Plato</th>
			<th>precio</th>
			<th>especialidad</th>
			<th>tipo</th>
		</tr>
	</thead>

	<tbody>
		<?php while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
			<tr>
				<td><?php echo $row['codPlato']; ?></td>
				<td><?php echo utf8_decode($row['nombrePlato']); ?></td>
				<td><?php echo $row['precio']; ?></td>
				<td><?php echo utf8_decode($row['especialidad']); ?></td>
				<td><?php echo utf8_decode($row['tipo']); ?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>