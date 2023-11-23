<?php
session_start();

include 'db_connection.php';

if (isset($_SESSION['id']) && isset($_POST['city'])) {
    $userId = $_SESSION['id'];
    $cityToAdd = mysqli_real_escape_string($conn, $_POST['city']);

    // Check if the city is already in favorites
    $checkQuery = mysqli_query($conn, "SELECT * FROM favorites WHERE user_id = $userId AND city = '$cityToAdd'");
    if (mysqli_num_rows($checkQuery) == 0) {
        // If the city is not in favorites, add it
        $insertQuery = mysqli_query($conn, "INSERT INTO favorites (user_id, city) VALUES ($userId, '$cityToAdd')");
        if (!$insertQuery) {
            echo "Error adding city to favorites: " . mysqli_error($conn);
        } else {
            echo "City added to favorites!";
        }
    } else {
        echo "City is already in favorites.";
    }
} else {
    echo "Invalid request.";
}
?>
