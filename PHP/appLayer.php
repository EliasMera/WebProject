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
	}


	function updateDB(){

		session_start();

		$username= $_SESSION['username'];
		$price = $_POST["price"];
		$picture = $_POST["picture"];
		$rent = $_POST["rent"];
		$sell = $_POST["sell"];
		$house = $_POST["house"];
		$dept = $_POST["dept"];
		$school = $_POST["school"];
		$market = $_POST["market"];
		$pool = $_POST["pool"];
		$ustate = $_POST["ustate"];
		$title = $_POST['title'];
		$direction = $_POST['direction'];
		$description = $_POST['description'];
		$date = date("Y/m/d");
		
		$result = updateFunction($price, $picture, $rent, $sell, $house, $dept, $school, $market, $pool, $ustate, $username, $title, $direction, $description, $date);

		if ($result["result"] == "ok"){   
			echo json_encode(array("result" => "ok"));
		}	
		else{
			die($result["result"]);
		}
	}


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

/*	function checkSessionF(){
	 	$result = checaSession();
	    
	    if ($result["result"] == "ok"){
			echo json_encode($result);
		}	
		else{
			header('HTTP/1.1 500' . $result["result"]);
			die($result["result"]);
		}
	 }

*/
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