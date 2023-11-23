<?php
session_start();

include("connection.php");

if (!isset($_SESSION['username'])) {
    header("location:login.php");
}

// Check if the user ID is provided in the URL
if (isset($_GET['id'])) {
    $userId = mysqli_real_escape_string($conn, $_GET['id']);

    // Delete the user
    $deleteQuery = mysqli_query($conn, "DELETE FROM users WHERE id = $userId");

    if (!$deleteQuery) {
        echo "Error deleting user: " . mysqli_error($conn);
    } else {
        header("Location: admin.php"); // Redirect back to the user listing page
        exit();
    }
} else {
    echo "User ID not provided.";
}
?>
