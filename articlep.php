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
    $stmt = $conn->prepare("INSERT INTO article(userid,title,contents,dateofcreation) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $userid, $title, $contents, $dateofcreation);
    
    $userid = $_POST['userid'];
    $title = $_POST['title'];
    $contents = $_POST['content'];
    $dateofcreation = $_POST['doc'];
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>