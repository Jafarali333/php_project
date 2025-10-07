<?php
include('dbconfig.php');

// Connect to the database
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user ID from the URL
if (isset($_GET['id'])) {
    $userId = intval($_GET['id']); // Sanitize user input

    // Optionally, you could perform a check to see if the user exists before deletion
    $checkSql = "SELECT * FROM users WHERE id = $userId";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        // Soft delete (mark as deleted) or hard delete
        $deleteSql = "UPDATE users SET deleted = 1 WHERE id = $userId"; // Assuming there's a deleted field
        
        if (mysqli_query($conn, $deleteSql)) {
            echo "User deleted successfully. <a href='userlist.php'>Go back to user list</a>";
        } else {
            echo "Error deleting user: " . mysqli_error($conn);
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "No user ID provided.";
}

mysqli_close($conn);
?>
