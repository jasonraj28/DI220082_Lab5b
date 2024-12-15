<?php
// Start a session to store user login state
session_start();

// Initialize variables
$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lab_5b";

    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Capture and sanitize inputs
    $matric = $conn->real_escape_string($_POST['matric']);
    $password = $_POST['password'];

    // Fetch the user from the database
    $sql = "SELECT * FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Authentication successful
            $_SESSION['logged_in'] = true;
            $_SESSION['matric'] = $matric;
            $_SESSION['role'] = $row['role'];
            header("Location: displayUser.php"); // Redirect to the page from Question 5
            exit();
        } else {
            $error = "Invalid username or password, try login again.";
        }
    } else {
        $error = "Invalid username or password, try login again.";
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="login.php">
        <label for="matric">Matric:</label>
        <input type="text" name="matric" id="matric" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <p style="color: red;"><?php echo $error; ?></p>
    <p><a href="register_form.php">Register</a> here if you have not.</p>
</body>
</html>
