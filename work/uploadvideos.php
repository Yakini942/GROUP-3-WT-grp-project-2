<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["video"]) && $_FILES["video"]["error"] == 0) {
        $userId = 1; // Example user ID, you should get this dynamically based on your user authentication
        
        $targetDir = "uploads/"; // Directory where uploaded videos will be stored
        $targetFile = $targetDir . basename($_FILES["video"]["name"]);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Allow certain file formats (adjust as needed)
        $allowedFormats = array("mp4", "avi", "mov", "wmv");
        
        if (in_array($fileType, $allowedFormats)) {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["video"]["tmp_name"], $targetFile)) {
                // Insert video details into database
                $type = "video"; // Type of multimedia (video)
                $location = $targetFile; // Path to the uploaded video file

                // Database connection parameters
                $servername = "localhost";
                $username = "your_username";
                $password = "your_password";
                $dbname = "bityeartwo2024";

                // Create database connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check database connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Prepare SQL statement to insert into multimedia table
                $sql = "INSERT INTO multimedia (userid, type, location) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iss", $userId, $type, $location);

                // Execute the prepared statement
                if ($stmt->execute()) {
                    echo "Video uploaded successfully.";
                } else {
                    echo "Error uploading video: " . $stmt->error;
                }

                // Close the database connection
                $stmt->close();
                $conn->close();
            } else {
                echo "Error uploading video.";
            }
        } else {
            echo "Unsupported video format. Please upload a video file in MP4, AVI, MOV, or WMV format.";
        }
    } else {
        echo "Error uploading video.";
    }
}
?>
