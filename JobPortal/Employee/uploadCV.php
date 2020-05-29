
<?php

//Upload CV
$uploadDir = 'uploads/';
$response = array(
    'status' => 0,
    'message' => 'Form submission failed, please try again.'
);

// If form is submitted 
if (isset($_POST['email']) || isset($_POST['file'])) {
    // Get the submitted form data 
    $email = $_POST['email'];
    //echo $_POST['file'];
    $uploadStatus = 1;

    // Upload file 
    $uploadedFile = '';
    if (!empty($_FILES["file"]["name"])) {

        // File path config 
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $uploadDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'JPG', 'PNG', 'JPEG');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to the server 
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                $uploadedFile = $fileName;
            } else {
                $uploadStatus = 0;
                $response['message'] = 'Sorry, The file Size Might be HIGH or File Corrupted.';
                // var_dump($_FILES);
            }
        } else {
            $uploadStatus = 0;
            $response['message'] = 'Sorry, PDF & DOC files are allowed to upload.';
        }
    }else{
        $uploadStatus = 0;
    }

    if ($uploadStatus == 1) {
        // Include the database config file 

        // Insert form data in the database 

        /*$mysqli = new mysqli("localhost","root","","jobplatdb");

                if ($mysqli -> connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                    exit();
                  }*/
        // include_once "includes/db_connect.php";
        // Database configuration 
        $dbHost     = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName     = "jobplatdb";

        // Create database connection 
        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        // Check connection 
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        /*$sql = "UPDATE seekerinfo SET  file_name='".$uploadedFile."' WHERE email='$email';";
                $insert = mysqli_query($conn, $sql);*/
        /* $insert = $db->query("UPDATE seekerinfo SET file_name='".$uploadedFile."' WHERE email='$email'");*/

        $insert = $db->query("UPDATE seekerinfo SET  file_name='" . $uploadedFile . "' WHERE email='$email';");

        if ($insert == true) {
            $response['status'] = 1;
            $response['message'] = 'CV Uploaded successfully!';
            //var_dump($_FILES);
            // echo "suc";
        } else {
            $response['status'] = 5;
            $response['message'] = 'Something is WRONG';
        }
    }
}

// Return response 
$myJSON = json_encode($response);
echo $myJSON;
//echo json_encode($response);

//Upload Image



