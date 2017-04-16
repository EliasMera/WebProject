<?php

header('Content-type: application/json');


	function connectionToDataBase(){
		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "ProyectoWeb";

		$conn = new mysqli($servername, $username, $password, $dbname);
		
		if ($conn->connect_error){
			return null;
		}
		else{
			return $conn;
		}
	}

	function updateFunction($price, $picture, $rent, $sell, $propertyType, $school, $market, $pool, $ustate, $username, $title, $direction, $description, $date){
		$conn = connectionToDataBase();

		if($conn != null){
			$sql = "UPDATE uploadedimages SET direccion = '$direction', titulo = '$title', estado = '$ustate', renta = '$rent', venta = '$sell', property = '$propertyType', precio = '$price', escuelas = '$school', mercado = '$market', pool = '$pool', descripcion = '$description', owner = '$username' , postedOn = '$date' WHERE imagen = '$picture'";

			$conn->query($sql);
			return array("result" => "ok");
			$conn->close();
		}
	}

	function deleteLastEnt($picture){
		$conn = connectionToDataBase();

		if($conn != null){

			$sql = "DELETE FROM uploadedImages WHERE imagen = '$picture'";
			$conn->query($sql);
			return array("result" => "ok");
			$conn->close();
		}

	}

	function loadN(){

		$loaded = array();

		$conn = connectionToDataBase();

		if($conn != null){
			$sql = "SELECT direccion, titulo, descripcion, venta, renta, property, precio, owner, imagen FROM uploadedImages";
			$result = $conn->query($sql);

		
			if ($result->num_rows > 0)
			{
				
				// output data of each row
			    while($row = $result->fetch_assoc()) 
			    {

			    	$response = array('imagen' => $row['imagen'],'direccion' => $row['direccion'], 'titulo' => $row['titulo'],'descripcion' => $row['descripcion'], 'venta' => $row['venta'], 'renta' => $row['renta'],'property' => $row['property'],'precio' => $row['precio'],'owner' => $row['owner']);
			    	
			    	array_push($loaded,$response);

				}
				echo json_encode($loaded);

			}
			else
			{

				$conn -> close();
				return array("result" => "BADCRED");

			}



		}
	}

	function loadMyUploads($owner){

		$loaded = array();

		$conn = connectionToDataBase();

		if($conn != null){
			$sql = "SELECT * FROM uploadedImages WHERE owner = '$owner'";
			$result = $conn->query($sql);

		
			if ($result->num_rows > 0)
			{
				
				// output data of each row
			    while($row = $result->fetch_assoc()) 
			    {

			    	$response = array('imagen' => $row['imagen'],'direccion' => $row['direccion'], 'titulo' => $row['titulo'],'descripcion' => $row['descripcion'], 'venta' => $row['venta'], 'renta' => $row['renta'],'property' => $row['property'],'precio' => $row['precio'],'owner' => $row['owner'], 'escuelas' => $row['escuelas'], 'mercado' => $row['mercado'], 'pool' => $row['pool']);
			    	
			    	array_push($loaded,$response);

				}
				echo json_encode($loaded);

			}
			else
			{

				$conn -> close();
				return array("result" => "BADCRED");

			}

		}
	}

	function attemptCheckSession(){

		session_start();

		if (isset($_SESSION["username"])) {
        
			return array("result" => "ok");
   	 	}
   	 	else{
			return array("result" => "SESSIONEXP");
		} 
	}

	function loginData($userName, $save) {
		// Create connection
		$conn = connectionToDataBase();

		if ($conn != null){
			$sql ="SELECT * FROM users WHERE username = '$userName'";
		
			$result = $conn->query($sql);

			if ($result->num_rows > 0)
			{
				setcookie("save", $save, time()+86400*30, "/","", 0);
            
                if($save == "true"){
                    setcookie("username", $userName, time()+86400*30, "/","", 0);
                }

                session_start();
                session_destroy();
                session_start();

                $row = $result->fetch_assoc();
                $psswrd = $row['passwrd'];

                $_SESSION["username"] = $userName;
                $_SESSION["email"] = $row['email'];
                $_SESSION["fname"] = $row['fName'];
                $_SESSION["lname"] = $row['lName'];

				$conn -> close();
				return array("result" => "ok", "password" => $psswrd);
			}
			else{
				$conn -> close();
				return array("result" => "User not found");
			}
		}else{
			$conn -> close();
			return array("result" => "Error, connection to DB");
		}
	}

	function registerData($fname, $lname, $username, $email, $password, $gender, $state){

		$conn = connectionToDataBase();

		$sql = "SELECT username FROM users WHERE username = '$username'";
		$result = $conn->query($sql);

		if($result->num_rows > 0){
			$conn -> close();
			return array("result" => "ErrorUserInUSE");
		}

		else{
			$sql = "INSERT INTO users (username, passwrd, fname, lname, gender, email, state) VALUES ('$username', '$password', '$fname','$lname','$gender','$email', '$state')";
	    	
	    	if (mysqli_query($conn, $sql)) 
	    	{

                setcookie("username", $username, time()+86400*30, "/","", 0);

			    //echo json_encode("New record created successfully");
			    $conn -> close();
			    session_start();
                session_destroy();
                session_start();
                $row = $result->fetch_assoc();
                $_SESSION["username"] = $username;
                $_SESSION["email"] = $email;
                $_SESSION["fname"] = $fname;
                $_SESSION["lname"] = $lname;
			    return array("result" => "ok");
			} 
			else {
				$conn -> close();
				return array("result" => "bad connection");
			}

		}

	}

		function attemptProfile($userName){

		//$userName = $_SESSION['username'];
		$conn = connectionToDataBase();

		$sql = "SELECT username, fName, lName, email, state, gender FROM Users WHERE username = '$userName'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0)
		{
			// output data of each row
		    while($row = $result->fetch_assoc()) 
		    {
		    	$response = array('username' => $row['username'], 'fName' => $row['fName'], 'lName' => $row['lName'], 'email' => $row['email'], 'gender' => $row['gender'], 'state' => $row['state']);   
			}
			
		    echo json_encode($response);
		}
		else
		{
			$conn -> close();
			return array("result" => "BADCRED");
		}

	
	return array("result" => "SESSIONEXP");

	}
	
	function logoutFunction(){
		session_start();
	 	unset($_SESSION['username']);
	 	session_destroy();
	    return array("result" => "ok");

	}

?>