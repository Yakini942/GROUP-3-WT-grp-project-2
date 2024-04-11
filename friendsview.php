<?php
//Ishimwe Mpundu Fideline 222003430  on 7th april 2024
                // Database connection parameters
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

$sql = "SELECT * FROM friends";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<title>The Information of friends</title>";
    echo "<h1>The Information of friends</h1>";
    echo "<table border='1'>
            <tr>
                <th>fid</th>
                <th>userid</th>
                <th>friendid</th>
                <th>username</th>
                
            </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["fid"] . "</td>";
        echo "<td>" . $row["userid"] . "</td>";
        echo "<td>" . $row["friendid"] . "</td>";
        
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
