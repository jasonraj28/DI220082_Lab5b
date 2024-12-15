<?php
// Database connection
$host = "localhost"; // Replace with your database host
$username = "root";  // Replace with your database username
$password = "";      // Replace with your database password
$dbname = "lab_5b";

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from users table
$sql = "SELECT matric, name, role AS accessLevel FROM users";
$result = $conn->query($sql);

// Display data in a table
if ($result->num_rows > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>Matric</th><th>Name</th><th>Level</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['matric']}</td>
                <td>{$row['name']}</td>
                <td>{$row['accessLevel']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No records found!";
}

// Close connection
$conn->close();
?>
