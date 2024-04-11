<?php
// shyaka-crisppin_222004852

$servername = "localhost";
$username = "admin";
$password = "bityear2@2024";
$dbname = "bityeartwo2024";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn ->connect_error){
	die("connection failed:".$conn ->connect_error);

}
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $userid =$_POST['userid']
	$campus = $_POST['campus'];
    $college = $_POST['college'];
    $school = $_POST['school'];
    $department = $_POST['department'];
    $level = $_POST['level'];
    $group = $_POST['group'];
    $regnumber = $_POST['regnumber'];
    $sql = "INSERT INTO profile (userid, Campus, College, School, Department, Level, Group, Regnumber)
            VALUES ('$userid',$campus', '$college', '$school', '$Department', '$level', '$group', '$regnumber')";

	 if ($conn->query($sql) === TRUE) {
        echo "New record recorded successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// shyaka_crispin_222004852
$conn->close();
?>