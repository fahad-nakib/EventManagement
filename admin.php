<?php
session_start();
include("db.php");
include("function.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $evn_name = $_POST['evn_name'];
    $evn_type = $_POST['evn_type'];
    $evn_desc = $_POST['evn_desc'];
    $evn_img = $_FILES['evn_img'];
    $evn_price = $_POST['evn_price'];

    if (!empty($evn_type) && !empty($evn_name) && !empty($evn_price)) {
        // Check if username or email already exists

        // Handle image upload
        $target_dir = "uploads/";
        // Check if the directory exists, if not, create it
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($evn_img["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($evn_img["tmp_name"]);
        if ($check === false) {
            die("File is not an image.");
        }

        // Check file size (limit to 500KB)
        if ($evn_img["size"] > 5000000) {
            die("Sorry, your file is too large.");
        }

        // Allow certain file formats
        $allowed_types = ["jpg", "png", "jpeg", "gif"];
        if (!in_array($imageFileType, $allowed_types)) {
            die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            die("Sorry, file already exists.");
        }

        // Attempt to move the uploaded file to the target directory
        if (!move_uploaded_file($evn_img["tmp_name"], $target_file)) {
            die("Sorry, there was an error uploading your file.");
        }

        // Save to database
        $query = "INSERT INTO eventlist(evn_type, evn_name, evn_desc, evn_price, evn_img) VALUES ('$evn_type','$evn_name','$evn_desc','$evn_price','$target_file')";
        mysqli_query($conn, $query);
        header("Location: admin.php#addevent");
        die;
    } else {
        echo "Please enter some valid information!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Event Booking-Responsive table || Learningrobo</title>
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">



    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <link rel="stylesheet" href="product_styles.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="evn_book.css">

    <style>
        .flex-container {
            display: flex;
            background-color: #f1f1f1;
            position: relative;
        }

        .flex-container>div {
            /* background-color: DodgerBlue; */
            color: white;
            width: 100%;
            position: relative;
        }

        .product {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .product img {
            /* max-width: 100%; */
            border-radius: 5px;
        }

        .product h2 {
            font-size: 20px;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .product p {
            color: #555;
            margin-bottom: 10px;
        }

        .product span {
            display: block;
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="51">
    <nav class="navbar fixed-top shadow-sm navbar-expand-lg">
        <div class="brand-title">CelebrationStation</div>
        <a href="javascript:void(0);" class="toggle-button" onclick="toggleMenu()">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="navbar-links navbar-nav ml-auto py-0" id="navbar-links">
            <ul>
                <li><a href="#addevent" class="nav-item nav-link active">ADD EVENT</a></li>
                <li><a href="#weadding" class="nav-item nav-link active">WEADDING</a></li>
                <li><a href="#engagement" class="nav-item nav-link active">ENGAGEMENT</a></li>
                <li><a href="#birthday" class="nav-item nav-link active">BIRTHDAY</a></li>
                <li><a href="#firstmeet" class="nav-item nav-link active">FIRSTMEET</a></li>
                <li><a href="#others" class="nav-item nav-link active">OTHERS</a></li>
                <li><a href="logout.php" class="nav-item nav-link active">LOGOUT</a></li>

            </ul>
        </div>
    </nav>
    <section>


        <!--Weadding Event Start -->
        <div class="container-fluid py-0" id="weadding">
            <div class="container py-5">
                <div class="section-title position-relative text-center">
                    <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;"></h6>
                    <h1 class="font-secondary display-4">Weadding Event</h1>
                    <i class="far fa-heart text-dark"></i>
                </div>
                <?php
                    $sql = "SELECT* FROM occation";
                    $result = mysqli_query($conn, $sql);
                
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        if ($row['evn_type'] == "weadding") 
                        {
                            $usql = "SELECT* FROM users WHERE id = '$row[user_id]'";
                            $uresult = mysqli_query($conn, $usql);
                            if($uresult)
			                {
				                if($uresult && mysqli_num_rows($uresult) > 0)
				                {
                                    $user_data = mysqli_fetch_assoc($uresult);
                        ?>
                                    <div class="product flex-container" >
                                        <div style="width: 400px;"><img src="<?php echo $user_data['profile_image'] ?>" alt="Product 1" height="200px" width="200px"></div>
                                        <div>
                                            <h2><?php echo $user_data['u_name'] ?></h2>
                                            <p>Pnone Number : <?php echo $user_data['phone'] ?></p>
                                            <p>Email : <?php echo $user_data['email'] ?></p>
                                            <span>Event Name : <?php echo $row['evn_name']."   (BDT ".$row['evn_price'].")" ?></span>
                                            <p>Event Date : <?php echo $row['evn_date'] ?>Event Time : <?php echo $row['evn_time'] ?></p>
                                        </div>
                                    </div>
                    <?php
                            }
                          }

                        }
                    }

                    ?>
            </div>
        </div>
        <!--Weadding Event End -->

        <!--Engagement Event Start -->
        <div class="container-fluid py-0" id="engagement">
            <div class="container py-5">
                <div class="section-title position-relative text-center">
                    <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;"></h6>
                    <h1 class="font-secondary display-4">Engagement Event</h1>
                    <i class="far fa-heart text-dark"></i>
                </div>
                <?php
                    $sql = "SELECT* FROM occation";
                    $result = mysqli_query($conn, $sql);
                
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        if ($row['evn_type'] == "engagement") 
                        {
                            $usql = "SELECT* FROM users WHERE id = '$row[user_id]'";
                            $uresult = mysqli_query($conn, $usql);
                            if($uresult)
			                {
				                if($uresult && mysqli_num_rows($uresult) > 0)
				                {
                                    $user_data = mysqli_fetch_assoc($uresult);
                        ?>
                                    <div class="product flex-container" >
                                        <div style="width: 400px;"><img src="<?php echo $user_data['profile_image'] ?>" alt="Product 1" height="200px" width="200px"></div>
                                        <div>
                                            <h2><?php echo $user_data['u_name'] ?></h2>
                                            <p>Pnone Number : <?php echo $user_data['phone'] ?></p>
                                            <p>Email : <?php echo $user_data['email'] ?></p>
                                            <span>Event Name : <?php echo $row['evn_name'] ?></span>
                                            <p>Event Date : <?php echo $row['evn_date'] ?>Event Time : <?php echo $row['evn_time'] ?></p>
                                        </div>
                                    </div>
                    <?php
                            }
                          }

                        }
                    }

                    ?>
            </div>
        </div>
        <!--Engagement Event End -->


        <!--Birthday Event Start -->
        <div class="container-fluid py-0" id="birthday">
            <div class="container py-5">
                <div class="section-title position-relative text-center">
                    <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;"></h6>
                    <h1 class="font-secondary display-4">Birthday Event</h1>
                    <i class="far fa-heart text-dark"></i>
                </div>
                <?php
                    $sql = "SELECT* FROM occation";
                    $result = mysqli_query($conn, $sql);
                
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        if ($row['evn_type'] == "birthday") 
                        {
                            $usql = "SELECT* FROM users WHERE id = '$row[user_id]'";
                            $uresult = mysqli_query($conn, $usql);
                            if($uresult)
			                {
				                if($uresult && mysqli_num_rows($uresult) > 0)
				                {
                                    $user_data = mysqli_fetch_assoc($uresult);
                        ?>
                                    <div class="product flex-container" >
                                        <div style="width: 400px;"><img src="<?php echo $user_data['profile_image'] ?>" alt="Product 1" height="200px" width="200px"></div>
                                        <div>
                                            <h2><?php echo $user_data['u_name'] ?></h2>
                                            <p>Pnone Number : <?php echo $user_data['phone'] ?></p>
                                            <p>Email : <?php echo $user_data['email'] ?></p>
                                            <span>Event Name : <?php echo $row['evn_name'] ?></span>
                                            <p>Event Date : <?php echo $row['evn_date'] ?>Event Time : <?php echo $row['evn_time'] ?></p>
                                        </div>
                                    </div>
                    <?php
                            }
                          }

                        }
                    }

                    ?>
            </div>
        </div>
        <!--Birthday Event End -->

        <!--Firstmeet Event Start -->
        <div class="container-fluid py-0" id="firstmeet">
            <div class="container py-5">
                <div class="section-title position-relative text-center">
                    <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;"></h6>
                    <h1 class="font-secondary display-4">Firstmeet Event</h1>
                    <i class="far fa-heart text-dark"></i>
                </div>
                <?php
                    $sql = "SELECT* FROM occation";
                    $result = mysqli_query($conn, $sql);
                
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        if ($row['evn_type'] == "firstmeet") 
                        {
                            $usql = "SELECT* FROM users WHERE id = '$row[user_id]'";
                            $uresult = mysqli_query($conn, $usql);
                            if($uresult)
			                {
				                if($uresult && mysqli_num_rows($uresult) > 0)
				                {
                                    $user_data = mysqli_fetch_assoc($uresult);
                        ?>
                                    <div class="product flex-container" >
                                        <div style="width: 400px;"><img src="<?php echo $user_data['profile_image'] ?>" alt="Product 1" height="200px" width="200px"></div>
                                        <div>
                                            <h2><?php echo $user_data['u_name'] ?></h2>
                                            <p>Pnone Number : <?php echo $user_data['phone'] ?></p>
                                            <p>Email : <?php echo $user_data['email'] ?></p>
                                            <span>Event Name : <?php echo $row['evn_name'] ?></span>
                                            <p>Event Date : <?php echo $row['evn_date'] ?>Event Time : <?php echo $row['evn_time'] ?></p>
                                        </div>
                                    </div>
                    <?php
                            }
                          }

                        }
                    }

                    ?>
            </div>
        </div>

        <!--Firstmeet Event End -->
    </section>


    <!--Others Event Start -->
    <section id="others">
        <div class="section-title position-relative text-center">
            <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;"></h6>
            <h1 class="font-secondary display-4">Others Event</h1>
            <i class="far fa-heart text-dark"></i>
        </div>

        <?php
                    $sql = "SELECT* FROM occation";
                    $result = mysqli_query($conn, $sql);
                
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        if ($row['evn_type'] == "others") 
                        {
                            $usql = "SELECT* FROM users WHERE id = '$row[user_id]'";
                            $uresult = mysqli_query($conn, $usql);
                            if($uresult)
			                {
				                if($uresult && mysqli_num_rows($uresult) > 0)
				                {
                                    $user_data = mysqli_fetch_assoc($uresult);
                        ?>
                                    <div class="product flex-container" >
                                        <div style="width: 400px;"><img src="<?php echo $user_data['profile_image'] ?>" alt="Product 1" height="200px" width="200px"></div>
                                        <div>
                                            <h2><?php echo $user_data['u_name'] ?></h2>
                                            <p>Pnone Number : <?php echo $user_data['phone'] ?></p>
                                            <p>Email : <?php echo $user_data['email'] ?></p>
                                            <span>Event Name : <?php echo $row['evn_name'] ?></span>
                                            <p>Event Date : <?php echo $row['evn_date'] ?>Event Time : <?php echo $row['evn_time'] ?></p>
                                        </div>
                                    </div>
                    <?php
                            }
                          }

                        }
                    }

                    ?>
    </section>
    <!--Others Event End -->

    <!-- Insart Start -->
    <div class="container-fluid py-5" id="addevent">
        <div class="container py-5">
            <div class="section-title position-relative text-center">
                <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Add Event</h6>
                <h1 class="font-secondary display-4">Insart New Event</h1>
                <i class="far fa-heart text-dark"></i>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <select class="form-control bg-secondary border-0" style="height: 52px;" name="evn_type">
                                        <option value="nothing">Event Type</option>
                                        <option value="weadding">Weadding</option>
                                        <option value="engagement">Engagement </option>
                                        <option value="birthday">Birth Day </option>
                                        <option value="firstmeet">First Meet </option>
                                        <option value="others">Others </option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control bg-secondary border-0 py-4 px-3" placeholder="Event Name" name="evn_name" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control bg-secondary border-0 py-4 px-3" placeholder="Event Price" name="evn_price" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="file" class="form-control bg-secondary border-0 py-4 px-3" placeholder="Event Photo" name="evn_img" />
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control bg-secondary border-0 py-2 px-3" rows="5" placeholder="Event Description" required="required" name="evn_desc"></textarea>
                            </div>
                            <div>
                                <button class="btn btn-primary font-weight-bold py-3 px-5" type="submit" value="insart">Insart</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Insart End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white py-5" id="contact" style="margin-top: 90px;">
        <div class="container text-center py-5">
            <div class="section-title position-relative text-center">
                <h1 class="font-secondary display-3 text-white">Thank You</h1>
                <i class="far fa-heart text-white"></i>
            </div>
            <div class="d-flex justify-content-center mb-4">
                <a class="btn btn-lg btn-outline-light btn-lg-square mr-2 bttn" href="#"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-lg btn-outline-light btn-lg-square mr-2 bttn" href="https://www.facebook.com/profile.php?id=100009813286993"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-lg btn-outline-light btn-lg-square mr-2 bttn" href="#"><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-lg btn-outline-light btn-lg-square bttn" href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="d-flex justify-content-center py-2">
                <p class="text-white" href="#">fahadnakib27@gmail.com</p>
                <span class="px-3">|</span>
                <p class="text-white" href="#">01963642898</p>
            </div>
            <!-- <p class="m-0">&copy; <a class="text-primary" href="#">Domain Name</a>. Designed by <a class="text-primary"
                    href="https://htmlcodex.com">HTML Codex</a>
            </p> -->
        </div>
    </div>
    <!-- Footer End -->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
</body>
<script>
    function toggleMenu() {
        var navbarLinks = document.getElementById("navbar-links");
        navbarLinks.classList.toggle("active");
    }
</script>

</html>