<?php
include("connection.php");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Perform the deletion query
    $deleteQuery = mysqli_query($conn, "DELETE FROM contact WHERE id = $id");

    if($deleteQuery) {
        // Redirect to the page where the messages are displayed
        header("Location: contactadmin.php");
        exit();
    } else {
        echo "Error deleting message: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request. Missing message ID.";
}
?>
