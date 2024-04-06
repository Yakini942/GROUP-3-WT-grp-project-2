<?php
$servername = "localhost";
$username = "admin";
$password = "bityear2@2024";
$dbname = "bityeartwo2024";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute SQL query
$sql = "SELECT * FROM employee";
$result = $conn->query($sql);

// Display data in HTML table
if ($result->num_rows > 0) {
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Department</th><th>Position</th><th>Salary</th><th>Action</th></tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['phone'] . '</td>';
        echo '<td>' . $row['department'] . '</td>';
        echo '<td>' . $row['position'] . '</td>';
        echo '<td>' . $row['salary'] . '</td>';
        echo '<td>';
        echo '<a href="update.php?id=' . $row['id'] . '">UPDATE</a>';
        echo '<a href="delete.php?id=' . $row['id'] . '">DELETE</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "No records found";
}

// Close database connection
$conn->close();
?>
