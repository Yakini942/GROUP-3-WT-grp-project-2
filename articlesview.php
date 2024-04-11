<?php
//Ishimwe Mpundu Fideline 222003430 on 7th april 2024
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

$sql = "SELECT * FROM article";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<title>The Information of article</title>";
    echo "<h1>The Information of article</h1>";
    echo "<table border='1'>
            <tr>
                <th>artid</th>
                <th>userid</th>
                <th>title</th>
                <th>contents</th>
                <th>dataofcreation</th>
               
            </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["artid"] . "</td>";
        echo "<td>" . $row["userid"] . "</td>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["contents"] . "</td>";
        echo "<td>" . $row["dataofcreation"] . "</td>";
       
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
