<?php
	function dbConexion(){
		$conn =	null;
	 	$host = 'localhost';
	 	$db = 	'db_tienda';
	 	$user = 'root';
	 	$pwd = 	'root';
		try {
		   	$conn = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pwd);
			//echo 'Connected succesfully.<br>';
		}
		catch (PDOException $e) {
			echo '<p>No se púede conectar a la base de datos !!</p>';
		    exit;
		}
		return $conn;
	}
 ?>
