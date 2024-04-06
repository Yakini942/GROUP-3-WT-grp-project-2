<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["videoFile"])) {
    // Configuration for database connection
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "bityeartwo2024";

    // Create database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle file upload
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["videoFile"]["name"]);
    $uploadOk = 1;
    $videoFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (adjust as needed)
    if ($_FILES["videoFile"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats (currently only allowing MP4)
    if ($videoFileType != "mp4") {
        echo "Sorry, only MP4 files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["videoFile"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["videoFile"]["name"])) . " has been uploaded.";

            // Insert uploaded video into multimedia table
            $sql = "INSERT INTO multimedia (userid, type, location) VALUES (1, 'video', '$targetFile')";
            if ($conn->query($sql) === TRUE) {
                echo " Video record inserted successfully.";
            } else {
                echo " Error inserting video record: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Close database connection
    $conn->close();
}
?>
