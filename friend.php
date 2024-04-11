<?php
// shyaka-crisppin_222004852

$servername = "localhost";
$username = "admin";
$password = "bityear2@2024";
$dbname = "bityeartwo2024";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $conn->prepare("INSERT INTO friends(fid,userid,friendid) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fid, $userid, $friendid);
    // Set parameters and execute
    $fid = $_POST['fid'];
    $userid = $_POST['userid'];
    $friendid = $_POST['friendid'];
   
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
