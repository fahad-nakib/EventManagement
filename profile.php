<?php
session_start();
include("db.php");
include("function.php");

$user_id = $_SESSION['id'];
$sql = "SELECT u_name, email, phone, profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
$conn->close();
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


    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="evn_book.css">
    <style>
      
        .profile-container {
            width: 450px;
            margin-top: 10%;
            margin-left: 35%;
            padding-left: 0%;
            padding-top: 0%;
            /* padding-top: 30px; */
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
        }
        .profile-header {
            background-color: #172A45;
            color: white;
            padding: 50px;
            font-size: 1.5em;
        }
        .profile-image img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            margin-top: -60px;
            border: 5px solid #fff;
            transition: transform 0.3s ease;
        }
        .profile-image img:hover {
            transform: scale(1.1);
        }
        .profile-info {
            padding: 20px;
            text-align: left;
        }
        .profile-info div {
            margin-bottom: 15px;
        }
        .profile-info label {
            display: block;
            font-weight: bold;
            color: #333;
        }
        .profile-info span {
            display: block;
            font-size: 1.1em;
            color: #555;
        }



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
            font-size: 20px;
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
                <li><a href="index.php#weadding" class="nav-item nav-link active">WEADDING</a></li>
                <li><a href="index.php#engagement" class="nav-item nav-link active">ENGAGEMENT</a></li>
                <li><a href="index.php#birthday" class="nav-item nav-link active">BIRTHDAY</a></li>
                <li><a href="index.php#firstmeet" class="nav-item nav-link active">FIRSTMEET</a></li>
                <li><a href="index.php#others" class="nav-item nav-link active">OTHERS</a></li>
                <li><a href="profile.php" class="nav-item nav-link active">PROFILE</a></li>
                <li><a href="logout.php" class="nav-item nav-link active">LOGOUT</a></li>

            </ul>
        </div>
    </nav>

    
    <section>
    <div class="profile-container">
    <div class="profile-header"></div>
    <div class="profile-image">
        <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Image">
    </div>
    <div class="profile-info">
        <div>
            <label>Name:</label>
            <span><?php echo htmlspecialchars($user['u_name']); ?></span>
        </div>
        <div>
            <label>Email:</label>
            <span><?php echo htmlspecialchars($user['email']); ?></span>
        </div>
        <div>
            <label>Contact:</label>
            <span><?php echo htmlspecialchars($user['phone']); ?></span>
        </div>
    </div>
</div>
    </section>
    <section>
    <div class="container-fluid py-0" id="weadding">
            <div class="container py-5">
                <div class="section-title position-relative text-center">
                    <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;"></h6>
                    <h1 class="font-secondary display-4">Your Booked Event</h1>
                    <i class="far fa-heart text-dark"></i>
                </div>
                <?php
                    include("db.php");
                    $sql = "SELECT* FROM occation WHERE user_id = '$user_id'";
                    $result = mysqli_query($conn, $sql);
                
                    while ($row = mysqli_fetch_assoc($result))
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
                                        <div style="width: 400px;"><img src="<?php echo $row['evn_img'] ?>" alt="Product 1" height="200px" width="200px"></div>
                                        <div>
                                            <h2><?php echo $user_data['u_name'] ?></h2>
                                            <p><h2>Event Type:<?php echo $row['evn_type'] ?></h2></p>
                                            <span>Event Name : <?php echo $row['evn_name']."   (BDT ".$row['evn_price'].")" ?></span>
                                            <p>Event Date : <?php echo $row['evn_date'].".    ." ?>Event Time : <?php echo $row['evn_time'] ?></p>
                                            <p>Event Description : <?php echo $row['evn_desc'] ?></p>
                                        </div>
                                    </div>
                    <?php
                                }
                        }
                    }

                    ?>
            </div>
        </div>
    </section>
        


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