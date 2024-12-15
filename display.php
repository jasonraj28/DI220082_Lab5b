<?php
// Step 1: Connect to the database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "Lab_5b";

$conn = new mysqli($host, $username, $password, $dbname);

// Step 2: Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 3: Fetch all user data from the users table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>
    <h2>User List</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th>
            <th>Action</th>
        </tr>

        <?php
        // Step 4: Loop through the query result and display user data in rows
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['matric']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['role']}</td>
                    <td>
                        <a href='update.php?matric={$row['matric']}'>Update</a> |
                        <a href='delete.php?matric={$row['matric']}' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Step 5: Close the database connection
$conn->close();
?>
