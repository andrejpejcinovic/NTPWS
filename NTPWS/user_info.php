<?php
session_start();

include("connection.php");

if (!isset($_SESSION['username'])) {
    header("location:login.php");
}

// Fetch user information
$userId = $_SESSION['id'];
$userQuery = mysqli_query($conn, "SELECT * FROM users WHERE id = $userId");
$userData = mysqli_fetch_assoc($userQuery);

// Process form submission for updating user information or password
$updateMessage = ""; // Initialize the update message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["updateInfo"])) {
        // Retrieve updated information from the form
        $newUsername = mysqli_real_escape_string($conn, $_POST["newUsername"]);
        $newEmail = mysqli_real_escape_string($conn, $_POST["newEmail"]);

        // Update user information in the 'users' table
        $updateQuery = mysqli_query($conn, "UPDATE users SET username = '$newUsername', email = '$newEmail' WHERE id = $userId");

        if (!$updateQuery) {
            echo "Error updating user information: " . mysqli_error($conn);
        } else {
            // Refresh user data after the update
            $userQuery = mysqli_query($conn, "SELECT * FROM users WHERE id = $userId");
            $userData = mysqli_fetch_assoc($userQuery);

            // Set the update message
            $updateMessage = "User information updated successfully!";
        }
    } elseif (isset($_POST["updatePassword"])) {
        // Retrieve updated password from the form
        $newPassword = mysqli_real_escape_string($conn, $_POST["newPassword"]);

        // Update user password in the 'users' table
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updatePasswordQuery = mysqli_query($conn, "UPDATE users SET password = '$hashedPassword' WHERE id = $userId");

        if (!$updatePasswordQuery) {
            echo "Error updating password: " . mysqli_error($conn);
        } else {
            // Set the update message
            $updateMessage = "Password updated successfully!";
        }
    }
}
?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
   

</head>

<body>

<header class="navbar-section">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="bi bi-cloud-drizzle-fill"></i> HoceLiPadat</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="home.php">Home</a>
                        </li>
                       <!--  <li class="nav-item">
                            <a class="nav-link" href="#services">services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">about us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#projects">projects</a>
                        </li> -->
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class='nav-link dropdown-toggle' href='edit.php?id=$res_id' id='dropdownMenuLink'
                                    data-bs-toggle='dropdown' aria-expanded='false'>
                                    <i class='bi bi-person'></i>
                                </a>


                                <ul class="dropdown-menu mt-2 mr-0" aria-labelledby="dropdownMenuLink">

                                    <li>
                                        <?php

                                        $id = $_SESSION['id'];
                                        $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");

                                        while ($result = mysqli_fetch_assoc($query)) {
                                            $res_username = $result['username'];
                                            $res_email = $result['email'];
                                            $res_id = $result['id'];
                                        }


                                        echo "<a class='dropdown-item' href='edit.php?id=$res_id'>Change Profile</a>";


                                        ?>

                                    </li>
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </div>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
    <!-- Display user information -->
    <!-- Add an "Edit" button -->
    <p></p>
    <h4>Uredite Vaš profil:</h4>

    <!-- Display success message if the form was submitted -->
    <?php if (!empty($updateMessage)) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $updateMessage; ?>
        </div>
    <?php endif; ?>

    <!-- Edit form for updating user information -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="edit-form">
        <label for="newUsername">Novo korisničko ime:</label>
        <input type="text" id="newUsername" name="newUsername" class="form-control" value="<?php echo $userData['username']; ?>" required>

        <label for="newEmail">Novi email:</label>
        <input type="email" id="newEmail" name="newEmail" class="form-control" value="<?php echo $userData['email']; ?>" required>

        <button type="submit" class="btn btn-secondary" name="updateInfo">Potvrdi</button>
    </form>

    <!-- Display additional user information if needed -->
</div>




    
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12">
                <p class="logo"><i class="bi bi-chat"></i> HoceLiPadat</p>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <ul class="d-flex">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">about us</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-12 col-sm-12">
                <p>&copy;HoceLiPadat</p>
            </div>

            <div class="col-lg-1 col-md-12 col-sm-12">
                <!-- back to top  -->

                <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                        class="bi bi-arrow-up-short"></i></a>
            </div>

        </div>

    </div>

</footer>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>


</html>