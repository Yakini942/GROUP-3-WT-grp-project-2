<?php
// Database connection code - adjust according to your database configuration
$servername = "localhost";
$username = "admin";
$password = "bityear2@2024";
$dbname = "bityeartwo2024";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//NIYONSHUTI Jean Pierre 222003223 on 7/4/2024
// Handle file upload
if (isset($_FILES["fileUpload"]) && $_FILES["fileUpload"]["error"] == 0) {
    $userid = $_POST["userid"];
    $type = $_POST["type"];
    $location = $_POST["location"];
    $uploaddate = $_POST["upload_date"];
    
    // File properties
   /* $file_name = $_FILES["fileUpload"]["name"];
    $file_size = $_FILES["fileUpload"]["size"];
    $tmpFileName = $_FILES["fileUpload"]["tmp_name"];
    $file_type = $_FILES["fileUpload"]["type"];
    
    // Read the file content
    $uploaddata = file_get_contents($tmpFileName);
    $uploaddata = mysqli_real_escape_string($conn, $uploaddata);*/

    // Prepare and bind SQL statement
    $sql = "INSERT INTO multimedia (userid, type, location, uploaddate) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $userid, $type, $location, $uploaddate);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Error uploading the image.";
}

// Close connection
$conn->close();
?>
