<?php
// shyaka-crisppin_222004852
$host ="localhost";
$user = "admin";
$pass = "bityear2@2024";
$database= "ityeartwo2024";

$conn = new mysqli($host,$user,$pass,$database);

if($conn ->connect_error){
	die("connection failed:".$conn ->connect_error);

}
if ($_SERVER["REQUEST_METHOD"]=="POST"){
	$campus = $_POST['campus'];
    $college = $_POST['college'];
    $school = $_POST['school'];
    $department = $_POST['department'];
    $level = $_POST['level'];
    $group = $_POST['group'];
    $regnumber = $_POST['regnumber'];
    $sql = "INSERT INTO profile (Campus, College, School, Department, Level, Group, Regnumber)
            VALUES ('$campus', '$college', '$school', '$Department', '$level', '$group', '$regnumber')";

	 if ($conn->query($sql) === TRUE) {
        echo "New record recorded successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// shyaka_crispin_222004852
$conn->close();
?>