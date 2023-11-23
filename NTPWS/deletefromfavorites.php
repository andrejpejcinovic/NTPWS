<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

include 'connection.php'; // Include your database connection file

if (isset($_GET['id'])) {
    $favoriteId = $_GET['id'];
    $userId = $_SESSION['id'];

    // Delete the favorite city from the database
    $deleteQuery = mysqli_query($conn, "DELETE FROM favorites WHERE user_id = $userId AND id = $favoriteId");

    if ($deleteQuery) {
        header("Location: home.php"); // Redirect back to home.php
        exit();
    } else {
        echo "Error removing city from favorites: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request!";
}
?>
