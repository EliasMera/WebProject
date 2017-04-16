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

	function updateFunction($price, $picture, $rent, $sell, $house, $dept, $school, $market, $pool, $ustate, $username, $title, $direction, $description){
		$conn = connectionToDataBase();

		if($conn != null){
			$sql = "UPDATE uploadedimages SET direccion = '$direction', titulo = '$title', estado = '$ustate', renta = '$rent', venta = '$sell', house = '$house', departamento = '$dept', precio = '$price', escuelas = '$school', mercado = '$market', pool = '$pool', descripcion = '$description', owner = '$username' WHERE imagen = '$picture'";

			$conn->query($sql);
			return array("result" => "ok");
			$conn->close();
		}
	}

	function deleteLastEnt($picture){
		$conn = connectionToDataBase();

		if($conn != null){

			$sql = "DELETE FROM uploadedImages WHERE imagen = '$picture'";
			return array("result" => "ok");
			$conn->close();
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
		//echo $result;
		//echo $result->num_rows;
		if ($result->num_rows > 0)
		{
			
			// output data of each row
		    while($row = $result->fetch_assoc()) 
		    {
		    	$response = array('username' => $row['username'], 'fName' => $row['fName'], 'lName' => $row['lName'], 'email' => $row['email'], 'gender' => $row['gender'], 'state' => $row['state']);   
			}
			
		    echo json_encode($response);
		    //echo json_encode($result->fetch_assoc());
		}
		else
		{
			$conn -> close();
			return array("result" => "BADCRED");
	    	//header('HTTP/1.1 406 User not found');
	        //die("Wrong credentials provided!");
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