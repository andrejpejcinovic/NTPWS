<?php
session_start();

include("connection.php");

if (!isset($_SESSION['username'])) {
    header("location:login.php");
}

// Fetch user notes
$userId = $_SESSION['id'];
$notesQuery = mysqli_query($conn, "SELECT * FROM user_notes WHERE user_id = $userId");

$userNotes = array(); // Initialize an array to store user notes

while ($note = mysqli_fetch_assoc($notesQuery)) {
    // Check if the 'note' index exists in the fetched data
    if (isset($note['note'])) {
        $userNotes[] = $note['note'];
    }
}

// Process form submission for adding new notes
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["newNote"])) {
        $newNote = mysqli_real_escape_string($conn, $_POST["newNote"]);

        // Insert the new note into the 'user_notes' table
        $insertQuery = mysqli_query($conn, "INSERT INTO user_notes (user_id, note) VALUES ($userId, '$newNote')");

        if (!$insertQuery) {
            echo "Error adding new note: " . mysqli_error($conn);
        }
    }
}
?>
