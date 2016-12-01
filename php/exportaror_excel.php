
<?php
require ("fpdf181/fpdf.php");
require ("clases/AccesoDatos.php");
require ("../slim/php/Pedido.php");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=export_excel.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Excel de Sucursales</title>
</head>
<body>
<table id="tabla1" width="100%" border="1" cellspacing="0" cellpadding="0">
	<tr><td colspan="3" bgcolor="skyblue" align="center">REPORTE TABLA DE SUCUSALES</td>
	</tr>
	<td><strong>Tipo</strong></td>
	<td><strong>Cantidad</strong></td>
	<td><strong>Nombre</strong></td>
	<tr>
<?php

$data=Pedidos::TraerPedidos();

try {
	foreach ($data as $row) 
	{
		$tipo=$row->tipo;
		$cantidad=$row->cantidad;
		$nombre=$row->nombre;
?>
	
		<td><?php echo $tipo; ?></td>
		<td><?php echo $cantidad; ?></td>
		<td><?php echo $nombre; ?></td>
	</tr>
<?php } } catch (Exception $e) {} ?>
</table>
<!--<form id="form1" name="form1" method="post"action="exportaror_excel.php" >
		<input type="submit" value="Exportar a Excel"/>
	</form>-->
</body>
</html>




