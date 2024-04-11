<?php
// shyaka-crisppin_222004852

$servername = "localhost";
$username = "admin";
$password = "bityear2@2024";
$dbname = "bityeartwo2024";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $stmt = $conn->prepare("INSERT INTO comment(cid,contentid,userid) VALUES ( ?,?, ?)");
    $stmt->bind_param("sss", $contentid, $userid);
    $contentid = $_POST['contentid'];
    $userid = $_POST['userid'];
    $cid = $_POST['cid'];
   
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
// crispin_shyaka_222004852