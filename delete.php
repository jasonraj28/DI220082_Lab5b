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

// Step 3: Check if 'matric' is passed in the URL
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    // Step 4: Prepare and execute the delete query
    $sql = "DELETE FROM users WHERE matric='$matric'";
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Step 5: Redirect back to the display page
header("Location: display.php");
exit();
?>
