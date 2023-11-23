<?php
session_start();

include("connection.php");

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit(); // Ensure that no further code is executed after the redirect
}

// Fetch user ID from the session
$userId = $_SESSION['id'];


// Check if there is a success message in the URL
if (isset($_GET['successMessage'])) {
    $successMessage = $_GET['successMessage'];
}

// Fetch user notes
$notesQuery = mysqli_query($conn, "SELECT * FROM user_notes WHERE user_id = $userId");

$userNotes = array(); // Initialize an array to store user notes

while ($note = mysqli_fetch_assoc($notesQuery)) {
    // Check if the 'note_content' and 'city' indexes exist in the fetched data
    if (isset($note['note_content'], $note['city'])) {
        $userNotes[] = "City: " . $note['city'] . " - Note: " . $note['note_content'];
    }
}
// Process form submission for deleting notes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteNote"])) {
    $noteToDelete = mysqli_real_escape_string($conn, $_POST["deleteNote"]);

    // Extract the city from the note (assuming the format is "City: [city] - Note: [note_content]")
    $cityPattern = "/City: (.*?) - Note:/";
    preg_match($cityPattern, $noteToDelete, $matches);
    $cityToDelete = isset($matches[1]) ? $matches[1] : null;

    if (!empty($cityToDelete)) {
        // Delete the note based on the user_id, city, and note_content
        $deleteQuery = mysqli_query($conn, "DELETE FROM user_notes WHERE user_id = $userId AND city = '$cityToDelete'");
        if ($deleteQuery) {
            $successMessage = "Uspješno dodano!";
            header("location: home.php?successMessage=" . urlencode($successMessage));
            exit();
        } else {
            $errorMessage = "Error deleting note: " . mysqli_error($conn);
        }
    } else {
        $errorMessage = "Error extracting city from the note.";
    }
}



// Process form submission for adding new notes
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["newNote"]) && isset($_POST["newCity"])) {
        $newNote = mysqli_real_escape_string($conn, $_POST["newNote"]);
        $newCity = mysqli_real_escape_string($conn, $_POST["newCity"]);

        // Insert the new note into the 'user_notes' table along with the city
        $insertQuery = mysqli_query($conn, "INSERT INTO user_notes (user_id, note_content, city) VALUES ($userId, '$newNote', '$newCity')");

        if ($insertQuery) {
            $successMessage = "Uspješno dodano!";
            // Redirect to the same page to avoid form resubmission
            header("location: home.php?successMessage=" . urlencode($successMessage));
            exit(); // Ensure that no further code is executed after the redirect
        } else {
            $errorMessage = "Error adding new note: " . mysqli_error($conn);
        }
    } else {
        $errorMessage = "";
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

    <!-- navbar section   -->

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
                            <a class="nav-link" aria-current="page" href="#home">Home</a>
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
                            <a class="nav-link" href="user_info.php">profil</a>
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
    </header>

    

 


<!-- navbar section   -->

<div class="name">
        <center>Dobrodošli
            <?php
            // echo $_SESSION['valid'];
            
            echo $_SESSION['username'];

            ?>
            !
        </center>
    </div>

<!-- hero section  -->

<!-- services section  -->

<section class="services-section" id="services">
    <div class="container">
        <div class="row">
        <div id="weather-widget">
    <h1>Pregledajte vremenske uvjete</h1>

    <?php
    // Include the PHP code to fetch and display the weather data
    include 'weather.php';

    // Check if the user is logged in
    if (isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];

// Fetch user's favorite cities from the database
$favoritesQuery = mysqli_query($conn, "SELECT * FROM favorites WHERE user_id = $userId");

// Check if there are any favorites for the user
if (mysqli_num_rows($favoritesQuery) > 0) {
    echo '<div class="favorites-list">';
    echo '<h2>Nedavno pretraživano</h2>';
    echo '<ul class="list-group">';

    while ($favorite = mysqli_fetch_assoc($favoritesQuery)) {
        echo '<li class="list-group-item">';
        // Add a class and data attribute to each city link
        echo '<a class="favorite-city" href="#" data-city="' . $favorite['city'] . '">' . $favorite['city'] . '</a>';
        echo ' | <a href="deletefromfavorites.php?id=' . $favorite['id'] . '">Izbriši</a>';
        echo '</li>';
    }

    echo '</ul>';
    echo '</div>';
}
}
?>


    <form method="post" id="weather-form">
        <div class="input-with-icon">
            <?php
            // Display the selected city from favorites in the input field
            if (isset($_GET['city'])) {
                $selectedCity = htmlspecialchars($_GET['city']);
                echo "<input type='text' name='city' value='$selectedCity' readonly>";
            } else {
                echo "<input type='text' name='city' placeholder='Unesite grad'>";
            }
            ?>
            <button type="submit" name="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>

    <?php
    if (isset($_POST["submit"]) && isset($weather)) { ?>
        <div class='name-city'>
            <h3><i class='fa-solid fa-location-dot'></i> <?php echo $weather['name']; ?></h3>
            <div><?php echo $hora_atual; ?></div>
        </div>
        <div class="container-date">
                <div>
                    <span class='celcius-degrees'>
                        <?php
                        // Display the temperature from the weather.php file
                        echo isset($celcius) ? $celcius : '';
                        ?>
                    </span>
                    <span class='degrees'>°</span>
                    <span class="celcius">C</span><br>
                    <div class="description">
                        <?php echo $weather['weather'][0]['description']; ?>
                    </div>
                </div>
                <div class='container-img'>
                    <img src='<?php echo $icon; ?>'>
                </div>
            </div>
            <div class='icons'>
                <div class="humidity">
                    <span>Humidity</span>
                    <div class="icons-humidity">
                        <i class='fa-solid fa-droplet'></i>
                        <?php echo $weather['main']['humidity'] . '%'; ?>
                    </div>
                </div>
                <div class="speed">
                    <span>Speed</span>
                    <div class="icons-speed">
                        <i class='fa-solid fa-wind'></i>
                        <?php echo $weather['wind']['speed']; ?>
                    </div>
                </div>
            </div>
        <?php
        // Add the city to favorites
        $cityToAdd = mysqli_real_escape_string($conn, $_POST['city']);
        $userId = $_SESSION['id'];

        // Check if the city is already in favorites
        $checkQuery = mysqli_query($conn, "SELECT * FROM favorites WHERE user_id = $userId AND city = '$cityToAdd'");
        if (mysqli_num_rows($checkQuery) == 0) {
            // If the city is not in favorites, add it
            $insertQuery = mysqli_query($conn, "INSERT INTO favorites (user_id, city) VALUES ($userId, '$cityToAdd')");
            if (!$insertQuery) {
                echo "Greška :(: " . mysqli_error($conn);
            } else {
                echo "!";
            }
        } else {
            echo "";
        }
        

        } elseif (isset($errorMessage)) {
            echo "$errorMessage";
        }

        if (isset($seven_day) && is_array($seven_day)&&isset($_POST["submit"])) { ?>
    <div class="weekly-details">
        <h2>Next 5 Days Forecast</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Clouds</th>
                    <th>Temp</th>
                    <th>Humidity</th>
                </tr>
            </thead>
            <?php
            $i = 0; // Start the loop from the beginning of the list
            while ($i < count($seven_day['list'])) {
                $temperatures = array();

                // Collect temperatures for the day
                for ($j = 0; $j < 8; $j++) {
                    $temperatures[] = $seven_day['list'][$i + $j]['main']['temp'];
                }

                // Calculate the median temperature
                $median_temperature = round(median($temperatures));

                // Display the table row
                ?>
                <tr>
                    <td>
                        <?php
                        echo date('l', $seven_day['list'][$i]['dt']);
                        ?>
                    </td>
                    <td>
                        <?php
                        $icon = $seven_day['list'][$i]['weather'][0]['icon'];
                        echo $logo = "<img src='http://openweathermap.org/img/w/" . $icon . ".png'>"
                        ?>
                    </td>
                    <td>
                        <ul class="list-unstyled">
                            <li>
                                <?php echo $median_temperature; ?><span>°</span><span>C</span><br>
                            </li>
                        </ul>
                    </td>
                    <td>
                        <?php echo $seven_day['list'][$i]["main"]["humidity"] ?>%
                    </td>
                </tr>
            <?php
                $i += 8; // Move to the next day (forecast data is available for every 3 hours, so skip 8 intervals for the next day)
            }
            ?>
        </table>
        
    </div>
<?php
}

// Function to calculate the median of an array
function median($arr)
{
    sort($arr);
    $count = count($arr);
    $middle = floor(($count - 1) / 2);
    $temp=($arr[$middle] + $arr[$middle + 1 - $count % 2]) / 2;
    $temp = number_format(($temp- 273.15), 0);
    return $temp;
}
?>

        

    </div>
</div>
<script>
    // Add a click event listener to all elements with the class 'favorite-city'
    document.querySelectorAll('.favorite-city').forEach(function (element) {
        element.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default behavior of the link
            var selectedCity = this.getAttribute('data-city'); // Get the city from the data attribute
            var inputField = document.querySelector('input[name="city"]');
            var submitButton = document.querySelector('button[name="submit"]');

            inputField.value = selectedCity; // Set the input field value
            submitButton.click(); // Trigger the click event on the submit button
        });
    });
</script>


</section>

<!-- Form to add new notes -->
<div class="container notes-section">
    <div class="row">
        <div class="col-md-6">
            <section class="add-note-section">
                <div class="container">
                    <h2>Dodajte novu zabilješku</h2>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <?php
                        // Display the selected city from the forecast in the input field
                        if (isset($_POST["submit"]) && isset($weather)) {
                            $selectedCity = htmlspecialchars($_POST["city"]);
                            echo "<input type='hidden' name='newCity' value='$selectedCity'>";
                        }
                        ?>
                        <div class="mb-3">
                            <!-- Remove the input field for newCity -->
                            <!-- <label for="newCity" class="form-label">City</label>
                            <input type="text" class="form-control" id="newCity" name="newCity" placeholder="Enter city name" required> -->
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="newNote" name="newNote" rows="4" placeholder="Unesite Vašu zabilješku" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </form>
                </div>
            </section>
        </div>

        <div class="col-md-6">
        <section class="user-notes-section">
    <div class="container">
        <?php
        if (isset($errorMessage)) {
            echo "<p class='error-message'>$errorMessage</p>";
        } elseif (isset($successMessage)) {
            echo "<p class='success-message'>$successMessage</p>";
        }
        ?>
        <h2>Vaše zabilješke</h2>
        <ul class="list-group">
            <?php foreach ($userNotes as $note) : ?>
                <li class="list-group-item">
                    <?php echo $note; ?>
                    <!-- Add a delete button for each note -->
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="display:inline;">
                        <input type="hidden" name="deleteNote" value="<?php echo htmlspecialchars($note); ?>">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>



        
        </div> 

    <!-- Form to add new notes -->
    
    </div>
    
</div>
<!-- footer section  -->

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-sm-12">
                <p class="logo"><i class="bi bi-cloud-drizzle-fill"></i> HoceLiPadat</p>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <ul class="d-flex">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">contact</a></li>
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