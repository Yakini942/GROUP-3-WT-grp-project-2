<?php
//NAYITURIKI LOUISE
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["audiofile"]) && $_FILES["audiofile"]["error"] == 0) {
        $userId = 1; // Example user ID, you should get this dynamically based on your user authentication

        $targetDir = "C:/Users/user/Music/Xampp/htdocs/AUDIO/"; // Absolute directory path
        $targetFile = $targetDir . basename($_FILES["audiofile"]["name"]);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Allow certain file formats (adjust as needed)
        $allowedFormats = array("mp4", "mp3", "m4a");

        if (in_array($fileType, $allowedFormats)) {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["audiofile"]["tmp_name"], $targetFile)) {
                // Insert Audio details into database
                $type = "Audio"; // Type of multimedia (Audio)
                $location = $targetFile; // Path to the uploaded Audio file
                $upload_date = date("Y-m-d H:i:s"); // Current date and time

                // Database connection parameters
                $servername = "localhost";
                $username = "root";
                $password = "";//this is empty because I din't set any password
                $dbname = "bityeartwo2024";

                // Create database connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check database connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Prepare SQL statement to insert into multimedia table
                $sql = "INSERT INTO multimedia (userid, type, location, upload_date) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isss", $userId, $type, $location, $upload_date);

                // Execute the prepared statement
                if ($stmt->execute()) {
                    echo "Audio uploaded successfully.";
                } else {
                    echo "Error uploading Audio: " . $stmt->error;
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
            } else {
                echo "Error uploading Audio.";
            }
        } else {
            echo "Unsupported Audio format. Please upload an audio file in MP4, MP3, or M4A format.";
        }
    } else {
        echo "Error uploading Audio.";
    }
}
?>