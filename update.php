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

// Step 3: Fetch user data if 'matric' is passed
if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $sql = "SELECT * FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

// Step 4: Update the user details if the form is submitted
if (isset($_POST['update'])) {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $updateSql = "UPDATE users SET name='$name', role='$role' WHERE matric='$matric'";
    if ($conn->query($updateSql) === TRUE) {
        echo "User updated successfully!";
        header("Location: display.php"); // Redirect back to display page
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <form action="update.php" method="post">
        <label for="matric">Matric:</label>
        <input type="text" name="matric" id="matric" value="<?php echo $row['matric']; ?>" readonly><br>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>" required><br>

        <label for="role">Access Level:</label>
        <select name="role" id="role" required>
            <option value="lecturer" <?php if ($row['role'] == 'lecturer') echo "selected"; ?>>Lecturer</option>
            <option value="student" <?php if ($row['role'] == 'student') echo "selected"; ?>>Student</option>
        </select><br>

        <input type="submit" name="update" value="Update">
        <a href="display.php"><button type="button">Cancel</button></a>
    </form>
</body>
</html>

<?php
// Step 5: Close the database connection
$conn->close();
?>
