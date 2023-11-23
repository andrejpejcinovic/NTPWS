<?php
session_start();

include("connection.php");





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
                            <a class="nav-link" aria-current="page" href="admin.php">Home</a>
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
                            <a class="nav-link" href="contactadmin.php">contact</a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class='nav-link dropdown-toggle' href='edit.php?id=$res_id' id='dropdownMenuLink'
                                    data-bs-toggle='dropdown' aria-expanded='false'>
                                    <i class='bi bi-person'></i>
                                </a>


                                <ul class="dropdown-menu mt-2 mr-0" aria-labelledby="dropdownMenuLink">

                                    
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </div>

                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>    <!-- users section -->
    <section class="users-section mt-5" style="display:none;">
        <div class="container">
            <h2>All Users</h2>
            <?php
            $query = mysqli_query($conn, "SELECT * FROM users");

            if (mysqli_num_rows($query) > 0) {
                echo "<table class='table'>";
                echo "<thead><tr><th>ID</th><th>Username</th><th>Email</th><th>Action</th></tr></thead>";
                echo "<tbody>";

                while ($result = mysqli_fetch_assoc($query)) {
                    $res_id = $result['id'];
                    $res_username = $result['username'];
                    $res_email = $result['email'];

                    echo "<tr>";
                    echo "<td>$res_id</td>";
                    echo "<td>$res_username</td>";
                    echo "<td>$res_email</td>";
                    echo "<td><a href='edit.php?id=$res_id'>Edit</a> | <a href='delete_user.php?id=$res_id'>Izbriši</a></td>";
                    echo "</tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "No users found.";
            }
            ?>
        </div>
    </section>

    <!-- contact section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <h1>Poruke</h1>
            <?php
            $contactQuery = mysqli_query($conn, "SELECT * FROM contact");
            if (mysqli_num_rows($contactQuery) > 0) {
                echo "<table class='table'>";
                echo "<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Action</th></tr></thead>";
                echo "<tbody>";
                while ($contactResult = mysqli_fetch_assoc($contactQuery)) {
                    $contactId = $contactResult['id'];
                    $contactName = $contactResult['name'];
                    $contactEmail = $contactResult['email'];
                    $contactSubject = $contactResult['subject'];
                    $contactMessage = $contactResult['message'];

                    echo "<tr>";
                    echo "<td>$contactId</td>";
                    echo "<td>$contactName</td>";
                    echo "<td>$contactEmail</td>";
                    echo "<td>$contactSubject</td>";
                    echo "<td>$contactMessage</td>";
                    echo "<td><a href='delete_contact.php?id=$contactId'>Izbriši</a></td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "No contact messages found.";
            }
            ?>
        </div>
    </section>


    <!-- ... (existing footer content) ... -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>
