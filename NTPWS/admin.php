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
    </header>

    

 


<!-- navbar section   -->



<!-- hero section  -->


<!-- <section id="home" class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 text-content">
                <h1>the digital service you really want</h1>
                <p>We build effective strategies to help you reach customers and prospects across the entire web.
                </p>
                <button class="btn"><a href="#">Estimate Project</a></button>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
                <img src="images/hero-image.png" alt="" class="img-fluid">
            </div>

        </div>
    </div>
</section> -->

<!-- services section  -->

<section class="services-section" id="services">
    <div class="container">
        <div class="row">
<!-- 
            <div class="col-lg-6 col-md-12 col-sm-12 services">

                <div class="row row1">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <img src="images/research.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h4 class="card-title">Research</h4>
                                <p class="card-text">We build effective strategies to help you reach customers
                                    and
                                    prospects
                                    across the entire.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <img src="images/brand.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h4 class="card-title">Branding</h4>
                                <p class="card-text">Brand identity represents the visual elements and assets
                                    that
                                    distinguish a brand.</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row row2">

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <img src="images/ux.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h4 class="card-title">UI/UX Design</h4>
                                <p class="card-text">UI/UX design services focus on creating intuitive &
                                    user-centric
                                    interfaces for digital products.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="card">
                            <img src="images/app-development.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h4 class="card-title">Development</h4>
                                <p class="card-text">A concept is brought to life through the services various
                                    stages, such
                                    as planning, testing and deployment.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div> -->

           <!-- users-section -->
<section class="users-section mt-5">
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
                echo "<td> 
                        <a href='delete_user.php?id=$res_id' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                      </td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "No users found.";
        }
        ?>
    </div>
</section>



<!--              <div id="weather-widget" >
                <div >
                    <?php
                    // Include the PHP code to fetch and display the weather data
                    include 'weather.php';
                    ?>
                    <h1>Weather App API</h1>
                    <form method="post">
                        <span class="date"><?php echo "Today is $day, $date $month<br>";?></span>
                        <div class="input-with-icon">
                            <input type="text" name="city" placeholder="Enter city name">
                            <button type="submit" name="submit"><i class="fas fa-search"></i></button>
                        </div>

                    </form>

                    <?php
                        if (isset($_POST["submit"]) && isset($weather)){?>
                            
                            <div class='name-city'>
                                <h3><i class='fa-solid fa-location-dot'></i> <?php echo $weather['name'];?></h3>
                                <div><?php echo $hora_atual;?></div>
                            </div>
                            <div class="container-date">
                                <div>
                                    <span class='celcius-degrees'><?php echo $celcius ?></span>
                                    <span class='degrees'>°</span> 
                                    <span class="celcius">C</span><br>
                                    <div class="description">
                                        <?php echo $weather['weather'][0]['description']?>
                                    </div>
                                </div>

                                <div class='container-img'>
                                    <img src='<?php echo $icon ?>'>
                                </div>
                            </div>
                                    
                            <div class='icons'>
                                <div class="humidity">
                                    <span>Humidity</span>
                                    <div class="icons-humidity">
                                        <i class='fa-solid fa-droplet'></i>  
                                        <?php echo $weather['main']['humidity'] . '%';?>
                                    </div>
                                    
                                </div>
                                <div class="speed">
                                    <span>Speed</span>
                                    <div class="icons-speed">
                                        <i class='fa-solid fa-wind'></i> 
                                        <?php echo $weather['wind']['speed'];?>
                                    </div>
                                </div>

                            </div>
                            
                        <?php 
                        } elseif (isset($errorMessage)){
                            echo "$errorMessage";
                            // unset($errorMessage);
                        }?>
                
                    </div>
                        </div>

                    </div>
                </div> -->
</section>

<!-- about section  -->
<!-- 
<section class="about-section" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <img src="images/about.jpg" alt="" class="img-fluid">
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 text-content">
                <h3>who we are</h3>
                <h1>Providing creative and technology services for growing brands.</h1>

                <p>Our company specializes in research, brand identity design, UI/UX design, development and graphic
                    design. To help our clients improve their business, we work with them all over the world.</p>
                <button>learn more</button>
            </div>
        </div>
    </div>
</section>

<!-- project section  

<section class="project-section" id="projects">
    <div class="container">
        <div class="row text">
            <div class="col-lg-6 col-md-12">
                <h3>our works</h3>
                <h1>Our latest project</h1>
                <hr>
            </div>
            <div class="col-lg-6 col-md-12">
                <p>We build product close to our heart. We make your idea to really and make your dream successful
                    with awesome experience.</p>
            </div>
        </div>
        <div class="row project">

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="images/project1.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="text">
                            <h4 class="card-title">SaaS Website</h4>
                            <p class="card-text">Development. Jan 19,2022</p>
                            <button>see project</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="images/project2.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="text">
                            <h4 class="card-title">Travel Website</h4>
                            <p class="card-text">UI/UX Jun 29,2023</p>
                            <button>see project</button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="images/project3.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="text">
                            <h4 class="card-title">Travel Website</h4>
                            <p class="card-text">UI/UX Aug 9,2021</p>
                            <button>see project</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <img src="images/project4.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="text">
                            <h4 class="card-title">SaaS Website</h4>
                            <p class="card-text">Development. May 25 ,2022</p>
                            <button>see project</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

                    -->
                    

<!-- 
<section class="contact-section" id="contact">
    <div class="container">

        <div class="row gy-4">

            <h1>contact us</h1>
            <div class="col-lg-6">

                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Address</h3>
                            <p>A108 Adam Street,<br>New Delhi, 535022</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-telephone"></i>
                            <h3>Call Us</h3>
                            <p>+91 9876545672<br>+91 8763456243</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-envelope"></i>
                            <h3>Email Us</h3>
                            <p>bragspot@gmail.com<br>brag@gmail.com</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <i class="bi bi-clock"></i>
                            <h3>Open Hours</h3>
                            <p>Monday - Friday<br>9:00AM - 05:00PM</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6 form">
                <form action="contact.php" method="POST" class="php-email-form">
                    <div class="row gy-4">

                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        </div>

                        <div class="col-md-6 ">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                        </div>

                        <div class="col-md-12">
                            <textarea class="form-control" name="message" rows="5" placeholder="Message"
                                required></textarea>
                        </div>

                        <div class="col-md-12 text-center">
                            <button type="submit" name="submit">Send Message</button>
                        </div>

                    </div>
                </form>

            </div>

        </div>

    </div>
</section>  -->

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