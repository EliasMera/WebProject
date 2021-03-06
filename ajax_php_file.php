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


$target_dir = "Images\\";



    $uploadOk = 1;
    $imageFileType = pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION);
    //generate uniq id.
    $uniqIdName = uniqid();
    //var to store on files.
    $target_file_upload_files = $target_dir.$uniqIdName.".".$imageFileType;
    //var to upload in db.
    $target_file_upload_db = $uniqIdName.".".$imageFileType;
    //data to insert db   

    // Check if file already exists
    if (file_exists($target_file_upload_files)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    //if ($_FILES["file"]["size"] > 900000) {
      //  echo "Sorry, your file is too large.";
        //$uploadOk = 0;
    //}

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";

    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file_upload_files)) {
            $conn = connectionToDataBase();

            $sql = "INSERT INTO uploadedImages VALUES ('' , '','' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' , '$target_file_upload_db', '', '', '')";

            $result = $conn->query($sql);
            $conn -> close();
            echo json_encode(array("result" => $target_file_upload_db));
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
?> 