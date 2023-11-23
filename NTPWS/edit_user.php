<?php
session_start();
include("connection.php");

if (isset($_SESSION['id'])) {
    $userId = $_SESSION['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle form submission for editing user details
        $newUsername = mysqli_real_escape_string($conn, $_POST['newUsername']);
        $newEmail = mysqli_real_escape_string($conn, $_POST['newEmail']);

        $updateQuery = mysqli_query($conn, "UPDATE users SET username = '$newUsername', email = '$newEmail' WHERE id = $userId");

        if ($updateQuery) {
            // Update successful
            header("Location: admin.php");
            exit();
        } else {
            echo "Error updating user details: " . mysqli_error($conn);
        }
    } else {
        // Fetch user details for pre-filling the form
        $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $userId");

        if ($query) {
            $result = mysqli_fetch_assoc($query);
            $currentUsername = $result['username'];
            $currentEmail = $result['email'];
        } else {
            echo "Error fetching user details: " . mysqli_error($conn);
        }
    }
} else {
    echo "User not logged in.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add your head content here -->
</head>

<body>
    <!-- Add your HTML content here -->
    <form method="POST" action="">
        <label for="newUsername">New Username:</label>
        <input type="text" name="newUsername" value="<?php echo $currentUsername; ?>" required>

        <label for="newEmail">New Email:</label>
        <input type="email" name="newEmail" value="<?php echo $currentEmail; ?>" required>

        <button type="submit" name="submit">Update</button>
    </form>
</body>

</html>
