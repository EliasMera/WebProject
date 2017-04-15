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


$target_dir = "C:\MAMP\htdocs\WebProject\Images\\";



    $uploadOk = 1;
    $imageFileType = pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION);
    //generate uniq id.
    $uniqIdName = uniqid();
    //var to store on files.
    $target_file_upload_files = $target_dir.$uniqIdName.".".$imageFileType;
    echo $target_file_upload_files;
    echo "AAAAAAAAAAAA";
    //var to upload in db.
    $target_file_upload_db = $uniqIdName.".".$imageFileType;
    echo $target_file_upload_db;
    //data to insert db
    
    /*$data = Array (
        "id" => $userNameFound['id'],
        "userName" => $userNameFound['email'],
        "password" => $userNameFound['password'],
        "userPhoto" => $target_file_upload_db
    );*/

    

    // Check if file already exists
    if (file_exists($target_file_upload_files)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["file"]["size"] > 900000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    /*if($imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg" || $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }*/

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";

    // if everything is ok, try to upload file
    } else {
        // move the temporary file to the real location with the correct name.
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file_upload_files)) {
            //echo "The file ". $target_file_upload_files. " has been uploaded.";
            //echo "The file db ". $target_file_upload_db. " has been uploaded.";
            $conn = connectionToDataBase();

            $sql = "INSERT INTO uploadedImages VALUES ('' , '','' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' , '$target_file_upload_db')";

            $result = $conn->query($sql);
            $conn -> close();
            return array("result" => "OKO");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
?> 