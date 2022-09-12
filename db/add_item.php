<?php


	require_once('conexion.php');

	$conn = dbConexion();

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$codigo1 = strip_tags($_POST['code']);

	if($nuevaConsulta = $conn->prepare("SELECT bar_code FROM tbl_articulos WHERE bar_code=:code")){
	  $nuevaConsulta->bindparam(':code', $codigo1);
	  $nuevaConsulta->execute();
	  $resultado = $nuevaConsulta->fetch();

	  if (is_countable($resultado) && count($resultado) > 0) {


			print '	<div id="addItemAlert" class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  	<p class="text-center"><strong>¡El código ' .$codigo1. ' del articulo ya existe!</strong></p>
					</div>';

	}else{

	$stmt1 = $conn->prepare("INSERT INTO tbl_articulos (bar_code, descripcion, cantidad_disponible, precio, precio_venta) VALUES (:cod, :des, :cant, :pr, :prV)");

	$stmt1->bindParam(':cod', $codigo);
	$stmt1->bindParam(':des', $descripcion);
	$stmt1->bindParam(':cant', $cantidad);
	$stmt1->bindParam(':pr', $precio_compra);
	$stmt1->bindParam(':prV', $precio_venta);

	$codigo = $_REQUEST["code"];
	$descripcion = $_REQUEST["desc"];
	$cantidad = $_REQUEST["cant"];
	$precio_compra = $_REQUEST["compra"];
	$precio_venta = $_REQUEST["venta"];

	$stmt1->execute();
	$conn = null;

	print '	<div id="addItemAlert" class="alert alert-success">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  	<p class="text-center"><strong>¡Nuevo artículo guardado satisfactoriamente!</strong></p>
			</div>';
		}
	}
?>
