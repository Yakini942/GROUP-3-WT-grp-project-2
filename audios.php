<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["audiofile"]) && $_FILES["audiofile"]["error"] == 0) {
        // Example user ID, you should get this dynamically based on your user authentication
        $userId = 1;

        // Absolute directory path
        $targetDir = "C:/Xampp/htdocs\GROUP-3-WT-grp-project-2-main/audios/";

        // Ensure the target directory exists and has appropriate permissions
        if (!file_exists($targetDir)) {
            echo "Error: Target directory does not exist.";
            exit;
        }

        // Get the file name and extension
        $fileName = basename($_FILES["audiofile"]["name"]);
        $targetFile = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Allow certain file formats (adjust as needed)
        $allowedFormats = array("mp4", "mp3", "m4a");

        if (in_array($fileType, $allowedFormats)) {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["audiofile"]["tmp_name"], $targetFile)) {
                // Database connection parameters
                $servername = "localhost";
                $username = "admin";
                $password = "bityear2@2024"; // Password is empty because you didn't set any password
                $dbname = "bityeartwo2024";

                // Create database connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check database connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Prepare SQL statement to insert into multimedia table
                $sql = "INSERT INTO multimedia (userid, type, location, upload_date) VALUES (?, ?, ?, NOW())";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iss", $userId, $fileType, $targetFile);

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
