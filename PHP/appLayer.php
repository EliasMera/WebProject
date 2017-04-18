<?php
	header('Content-type: application/json');
	require_once __DIR__ . '/dataLayer.php';

	$action = $_POST["action"];

	switch($action){
		case "login" : login();
						break;
		case "logout" : logout();
						break;
		case "registerUser" : registerUser();
						break;
		case "checkSession" : checkSessionF();
						break;
		case "loadProfile" : loadProfile();
						break;
		case "upload" : uploadImage();
						break;
		case "updateEntry" : updateDB();
						break;
		case "delete" : deleteLastEntry();
						break;
		case "loadNResults" : loadNRes();
						break;
		case "loadmyuploads" : loadUploads();
						break;
		case "refresh" : refresh();
						break;
		case "delListing" : delListing();
						break;
		case "search" : search();
						break;
	}


	function updateDB(){

		session_start();

		$username= $_SESSION['username'];
		$email = $_SESSION['email'];
		$price = $_POST["price"];
		$picture = $_POST["picture"];
		$rent = $_POST["rent"];
		$sell = $_POST["sell"];
		$propertyType = $_POST["propertyType"];
		$school = $_POST["school"];
		$market = $_POST["market"];
		$pool = $_POST["pool"];
		$ustate = $_POST["ustate"];
		$title = $_POST['title'];
		$direction = $_POST['direction'];
		$description = $_POST['description'];
		$date = date("Y/m/d");
		
		$result = updateFunction($price, $picture, $rent, $sell, $propertyType, $school, $market, $pool, $ustate, $username, $title, $direction, $description, $date, $email);

		if ($result["result"] == "ok"){   
			echo json_encode(array("result" => "ok"));
		}	
		else{
			die($result["result"]);
		}
	}

	function refresh(){
		$from = $_POST["from"];
		$to = $_POST["to"];
		$rent = $_POST["rent"];
		$sell = $_POST["sell"];
		$school = $_POST["school"];
		$market = $_POST["market"];
		$pool = $_POST["pool"];
		$ustate = $_POST["ustate"];
		$house = $_POST["house"];
		$dept = $_POST["dept"];

		$result = refreshFunction($from, $to, $rent, $sell, $school, $market, $pool, $ustate, $house, $dept);

		if ($result["result"] == "ok"){   
			echo json_encode(array("result" => "ok"));
		}	
		else{
			die($result["result"]);
		}
	}

	//Este es el delete de cuando se sube una imagen pero se dejan los campos en blanco en la forma de publish
	function deleteLastEntry(){
		$picture = $_POST["picture"];
		$result = deleteLastEnt($picture);
		if ($result["result"] == "ok"){   
			echo json_encode(array("result" => "ok"));
		}	
		else{
			die($result["result"]);
		}
	}


	//borra un listing que esta craedo correctamente en myuploads
	function delListing(){
		$delList = $_POST['delList'];
		$result = deleteListing($delList);
		if ($result["result"] == "BADCRED"){
			echo json_encode(array("result" => "Wrong credentials provided"));
		}
		echo json_encode(array("result" => "ok"));
	}

	function loadNRes(){
		$result = loadN();
		if ($result["result"] == "BADCRED"){
			echo json_encode(array("message" => "Wrong credentials provided"));
		}
	}

	function search(){
		$address = $_POST["address"];
		$result = searchFunction($address);
		if ($result["result"] == "BADCRED"){
			echo json_encode(array("message" => "Wrong credentials provided"));
		}
	}

	function loadUploads(){
		session_start();
		$owner = $_SESSION['username'];
		$result = loadMyUploads($owner);
		if ($result["result"] == "ok"){   
			echo json_encode(array("result" => "ok"));
		}	
		else{
			die($result["result"]);
		}
	}



	function decrypt($password){
		$key = pack('H*', "bcb04b7e103a05afe34763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
	    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
	    $ciphertext_dec = base64_decode($password);
	    $iv_dec = substr($ciphertext_dec, 0, $iv_size);
	    $ciphertext_dec = substr($ciphertext_dec, $iv_size);
	    $password = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);	   	
	   	$count = 0;
	   	$length = strlen($password);
	    for ($i = $length - 1; $i >= 0; $i--){
	    	if (ord($password{$i}) === 0){
	    		$count++;
	    	}
	    }
	    $password = substr($password, 0,  $length - $count); 
	    return $password;
	}

	function encrypt(){
		$userPassword = $_POST['passwrd'];
	    $key = pack('H*', "bcb04b7e103a05afe34763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
	    $key_size = strlen($key);
	    $plaintext = $userPassword;
	    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
	    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	    $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $plaintext, MCRYPT_MODE_CBC, $iv);
	    $ciphertext = $iv . $ciphertext;
	    $userPassword = base64_encode($ciphertext);
	    return $userPassword;
	}

	function login() {
		$userName = $_POST["userName"];
		$userPassword = $_POST["userPassword"];
		$save = $_POST["rememberValue"];

		$result = loginData($userName, $save);

		if ($result["result"] == "ok"){
			$decryptedPassword = decrypt($result['password']);

			if ($decryptedPassword === $userPassword){	
		    	$response = array("result" => "COMPLETE");   
			    echo json_encode(array("result" => "ok"));
			}
		}	
		else{
			die($result["result"]);
		}	
	}

	function registerUser(){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = encrypt();
		$gender = $_POST['gender'];
		$state = $_POST['state'];

		session_start();

		if(isset($_SESSION['username'])) {
			session_unset();
		}


		$_SESSION['username'] = $username;

		$result = registerData($fname, $lname, $username, $email, $password, $gender, $state);

		if($result['result'] == "ok"){
			echo json_encode(array("result" => "ok"));
		}
		else{
			echo json_encode(array("result" => "error"));
		}
	}

	function loadProfile(){
		session_start();
		$userName = $_SESSION['username'];
		

		$result = attemptProfile($userName);

		if ($result["result"] == "BADCRED"){
			echo json_encode(array("message" => "Wrong credentials provided"));
		}
	}

	function checkSessionF()
 	{
 		$result = attemptCheckSession();
  	    if ($result["result"] == "ok"){
			echo json_encode(array("result" => "ok"));
		}	
		else
			if($result["result"] == "SESSIONEXP"){
			die($result["result"]);
		}
	}

	function logout() {
		$result = logoutFunction();
    
	    if ($result["result"] == "ok"){
			echo json_encode(array("result" => "Logout succesfull"));
		}	
		else{
			die($result["result"]);
		}
	}
?>