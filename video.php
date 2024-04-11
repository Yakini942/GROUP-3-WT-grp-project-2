<?php
// this php codes created by janvier ishimwe 222003960
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["videofile"]) && $_FILES["videofile"]["error"] == 0) {
        $userId = 1; // Example user ID, should be retrieved dynamically

        $targetDir = "C:/xampp/htdocs/GROUP-3-WT-grp-project-2-main/video/";
        $targetFile = $targetDir . basename($_FILES["videofile"]["name"]);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Allowed video formats
        $allowedFormats = array("mp4", "avi", "mov", "mkv", "wmv");

        if (in_array($fileType, $allowedFormats)) {
            if (move_uploaded_file($_FILES["videofile"]["tmp_name"], $targetFile)) {
                $type = "video";
                $location = $targetFile;
                $upload_date = date("Y-m-d H:i:s");
      // Create database connection
                   $servername = "localhost";
                $username = "admin";
                $password = "bityear2@2024";//this is empty because I din't set any password
                $dbname = "bityeartwo2024";

                // Create database connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check database connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "INSERT INTO multimedia (userid, type, location, upload_date) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isss", $userId, $type, $location, $upload_date);

                if ($stmt->execute()) {
                    echo "Video uploaded successfully.";
                } else {
                    echo "Error uploading video: " . $stmt->error;
                }

                $stmt->close();
                $conn->close();
            } else {
                echo "Error uploading video.";
            }
        } else {
            echo "Unsupported video format. Please upload a video file in MP4, AVI, MOV, MKV, or WMV format.";
        }
    } else {
        echo "Error uploading video.";
    }
}
?>