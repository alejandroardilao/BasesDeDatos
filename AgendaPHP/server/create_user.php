<?php
	require('conector.php');
	$con = new conectorBD();

	$response['conexion'] = $con->initConexion($con->database);
	if ($response['conexion'] == 'OK'){
		$conexion = $con->getConexion();
		$insert = $conexion->prepare('INSERT INTO usuarios (email, nombre, password , fecha_nacimiento) VALUES (?,?,?,?)');
		$insert->bind_param("ssss", $email, $nombre, $password, $fecha_nacimiento);

		$d_password = "1234";//define contraseña

		$email = 'usuario@mail.com';
		$nombre = 'usuario';
		$password = password_hash($d_password, PASSWORD_DEFAULT);//encriptación de contraseña
		$fecha_nacimiento = '1997-12-03';

		$insert->execute();

		$email = 'carlos@mail.com';
		$nombre = 'carlos';
		$password = password_hash($d_password, PASSWORD_DEFAULT);//encriptación de contraseña
		$fecha_nacimiento = '1997-12-03';

		$insert->execute();

		$email = "alejandro@mail.com";
		$nombre = "alejandro";
		$password = password_hash($d_password, PASSWORD_DEFAULT);//encriptación de contraseña
		$fecha_nacimiento = "1998-12-08";

		$insert->execute();

		$response['resultado'] = "1";
		$response['msg']= 'Información de inicio:';
		$getUsers = $con->consultar(['usuarios'],['*'],$condicion = "");
		while ($fila= $getUsers->fetch_assoc()) {
			$response['msg'].=$fila['email'];
		}
		$response['msg'].= 'contraseña: '.$d_password;
		}else{
			$response['resultado'] == "0";
			$response['msg'] = 'No se pudo conectar a la base de datos';
		}

		echo json_encode($response);

 ?>
