<?php
 session_start();
include("db.php");
include("function.php");
  
  check_login_redirect($conn);

  if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$email = $_POST['email'];
		$password = $_POST['password'];
        $designation = $_POST['designation'];

		if(!empty($email) && !empty($password))
		{
			//read from database
			$query = "select * from users where email = '$email' limit 1";
			$result = mysqli_query($conn, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['u_password'] === $password && $designation == "user" && $user_data['designation'] === $designation )
					{

						$_SESSION['id'] = $user_data['id'];
						header("Location: evn_book.php");
						die;
					}elseif($user_data['u_password'] === $password && $designation == "admin" && $user_data['designation'] === $designation ){
                        $_SESSION['id'] = $user_data['id'];
						header("Location: admin.php");
						die;
                    }
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CelebrationStation</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <style>
        .signUp{
            background-color: #FFFFFF;
            color: #E47A2E;
           
        }
    </style>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="51">
    <!-- Navbar Start -->
    <nav class="navbar fixed-top shadow-sm navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
        <a href="index.html" class="navbar-brand d-block d-lg-none">
            <h1 class="font-secondary text-white mb-n2">CelebrationStation</h1>
            <!-- Jack <span class="text-primary">&</span> Rose -->
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav ml-auto py-0">
                <a href="#home" class="nav-item nav-link active">Home</a>
                <a href="#about" class="nav-item nav-link">About</a>
                <a href="#story" class="nav-item nav-link">Story</a>
                <a href="#gallery" class="nav-item nav-link">Gallery</a>
            </div>
            <a href="index.html" class="navbar-brand mx-5 d-none d-lg-block">
                <h1 class="font-secondary text-white mb-n2">CelebrationStation</h1>
            </a>
            <div class="navbar-nav mr-auto py-0">
                <!-- <a href="#family" class="nav-item nav-link">Family</a> -->
                <a href="#event" class="nav-item nav-link">Event</a>
                <a href="#rsvp" class="nav-item nav-link">EventBooking</a>
                <a href="#contact" class="nav-item nav-link">Contact</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 pb-5" id="home">
        <div id="header-carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item position-relative active" style="height: 100vh; min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="img/carousel-1.jpg" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-1 font-secondary text-white mt-n3 mb-md-4">CelebrationStation</h1>
                            <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                <h3 class="text-uppercase font-weight-normal text-white m-0"
                                    style="letter-spacing: 2px;">We've the pleasure of organizing events </h3>
                            </div>
                            <button type="button" class="btn-play mx-auto" data-toggle="modal"
                                data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-target="#videoModal">
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="carousel-item position-relative" style="height: 100vh; min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="img/carousel-2.jpg" style="object-fit: cover;">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-1 font-secondary text-white mt-n3 mb-md-4">CelebrationStation</h1>
                            <div class="d-inline-block border-top border-bottom border-light py-3 px-4">
                                <h3 class="text-uppercase font-weight-normal text-white m-0"
                                    style="letter-spacing: 2px;">We've the pleasure of organizing events</h3>
                            </div>
                            <button type="button" class="btn-play mx-auto" data-toggle="modal"
                                data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-target="#videoModal">
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev justify-content-start" href="#header-carousel" data-slide="prev">
                <div class="btn btn-primary px-0" style="width: 68px; height: 68px;">
                    <span class="carousel-control-prev-icon mt-3"></span>
                </div>
            </a>
            <a class="carousel-control-next justify-content-end" href="#header-carousel" data-slide="next">
                <div class="btn btn-primary px-0" style="width: 68px; height: 68px;">
                    <span class="carousel-control-next-icon mt-3"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Video Modal Start -->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <!-- 16:9 aspect ratio -->
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always"
                            allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Modal End -->


    <!-- About Start -->
    <div class="container-fluid py-5" id="about">
        <div class="container py-5">
            <div class="section-title position-relative text-center">
                <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">About</h6>
                <h1 class="font-secondary display-4">Fahad & Shihab</h1>
                <i class="far fa-heart text-dark"></i>
            </div>
            <div class="row m-0 mb-4 mb-md-0 pb-2 pb-md-0">
                <div class="col-md-6 p-0 text-center text-md-right">
                    <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                        <h3 class="mb-3">Md. Fahad Nakib</h3>
                        <p><b>Our Mission :</b><br>
                            Our team of passionate and dedicated professionals is the heart of Celebration Station.
                            With diverse backgrounds in event planning, design, hospitality, and logistics, we bring a
                            wealth of experience and expertise to every project. We work collaboratively to ensure your
                            event is flawlessly executed and truly extraordinary.</p>
                        <h3 class="font-secondary font-weight-normal text-muted mb-3"><i
                                class="fa fa-male text-primary pr-3"></i>Fahad</h3>
                        <div class="position-relative">
                            <a class="btn btn-outline-primary btn-square mr-1" href="#"><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-1" href="https://www.facebook.com/profile.php?id=100009813286993"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-1" href="#"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-0" style="min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="img/about-1.jpg" style="object-fit: cover;">
                </div>
            </div>
            <div class="row m-0">
                <div class="col-md-6 p-0" style="min-height: 400px;">
                    <img class="position-absolute w-100 h-100" src="img/about-2.jpg" style="object-fit: cover;">
                </div>
                <div class="col-md-6 p-0 text-center text-md-left">
                    <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                        <h3 class="mb-3">Md. Shihabur Rahman</h3>
                        <p><b>What we do :</b><br>
                            <b>Event Planning:</b> From planning to execution, we manage every aspect of your event with precision and creativity. <br>
                            <b>Venue Selection:</b> We help you find the perfect venue that matches your theme, budget, and vision. <br>
                            <b>Decor and Design:</b> Our creative team designs breathtaking decor that transforms spaces and captivates guests. <br>
                            <b>Entertainment:</b> We provide top-notch entertainment options to keep your guests engaged and entertained. <br>
                            </p>
                            <h3 class="font-secondary font-weight-normal text-muted mb-3"><i
                            class="fa fa-male text-primary pr-3"></i>Shihab</h3>
                        <div class="position-relative">
                            <a class="btn btn-outline-primary btn-square mr-1" href="https://l.facebook.com/l.php?u=https%3A%2F%2Fwww.instagram.com%2Fshihab.154%3Ffbclid%3DIwZXh0bgNhZW0CMTAAAR17Tg99OInSbylehp76jvworvgJLueC0kJVm-qGBh7lz-ZKgAevwWMSgnU_aem_ASQwSkLS5mn6wM4tA3f3yK15zj3EIowvAEUnC12CqfxK5qJzgFrSoOTPJAqeJEBw1NPJlLTFRXtexGMDjOsQHWCY&h=AT3Xi8aZarneoHWKHPD00njfZ2_a3vrGmjwGrhK8FG-2MBvvL-m2joKNFyqj7IE5qJtCOcPSQSa4_XtepAVsisZJRbTw--mhx87fDYkUhEC73kSXAv2yVj7nnV7fwDgRgPab"><i
                                    class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-1" href="https://www.facebook.com/mdshihabur.rahman.94"><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-primary btn-square mr-1" href="https://l.facebook.com/l.php?u=https%3A%2F%2Flinkedin.com%2Fin%2Fmd-shihabur-rahman-3606b4248%3Ffbclid%3DIwZXh0bgNhZW0CMTAAAR0dxLeyxeo7mlFzy-tHDKqqGJ9h9dtV_LU1dqseHb_39CMNjLrIInIVlqE_aem_ASQXnHS1oBrYMLdKAA3td41TzlsR3V0zEzASi0ofK7R9hiXmVI0BV_mJbg0a9qrcel35cg2h3xQRTU-rBv3g4hW2&h=AT3oy6aXgcLsQ8QqwtLHWn2kPz-4rq1hRU6oC87v6a0AqxcNhtlBP0U6W8Gq7dC0by4MC_KMMSiMxhMcvE5FoslKXH_1Mf-ZRejAjZDi52tOAM1ADSagZURUFjeOdLIYvZ1G"><i
                                    class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-outline-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->



    <!-- Story Start -->
    <div class="container-fluid py-5" id="story">
        <div class="container pt-5 pb-3">
            <div class="section-title position-relative text-center">
                <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Story</h6>
                <h1 class="font-secondary display-4">Our Event Story</h1>
                <i class="far fa-heart text-dark"></i>
            </div>
            <div class="container timeline position-relative p-0">
                <div class="row">
                    <div class="col-md-6 text-center text-md-right">
                        <img class="img-fluid mr-md-3" src="img/story-1.png" alt="">
                    </div>
                    <div class="col-md-6 text-center text-md-left">
                        <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4 ml-md-3">
                            <h4 class="mb-2">Weadding</h4>
                            <p class="text-uppercase mb-2">01 Jan 2050</p>
                            <p class="m-0">Lorem elitr magna stet rebum dolores sed. Est stet labore est lorem lorem at
                                amet sea, eos tempor rebum, labore amet ipsum sea lorem, stet rebum eirmod amet. Kasd
                                clita kasd stet amet est dolor elitr.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-center text-md-right">
                        <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4 mr-md-3">
                            <h4 class="mb-2">Enagagement</h4>
                            <p class="text-uppercase mb-2">01 Jan 2050</p>
                            <p class="m-0">Lorem elitr magna stet rebum dolores sed. Est stet labore est lorem lorem at
                                amet sea, eos tempor rebum, labore amet ipsum sea lorem, stet rebum eirmod amet. Kasd
                                clita kasd stet amet est dolor elitr.</p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center text-md-left">
                        <img class="img-fluid ml-md-3" src="img/story-2.png" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-center text-md-right">
                        <img class="img-fluid mr-md-3" src="img/story-3.jpg" alt="">
                    </div>
                    <div class="col-md-6 text-center text-md-left">
                        <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4 ml-md-3">
                            <h4 class="mb-2">Birth Day</h4>
                            <p class="text-uppercase mb-2">01 Jan 2050</p>
                            <p class="m-0">Lorem elitr magna stet rebum dolores sed. Est stet labore est lorem lorem at
                                amet sea, eos tempor rebum, labore amet ipsum sea lorem, stet rebum eirmod amet. Kasd
                                clita kasd stet amet est dolor elitr.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-center text-md-right">
                        <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-4 mr-md-3">
                            <h4 class="mb-2">First Meet</h4>
                            <p class="text-uppercase mb-2">01 Jan 2050</p>
                            <p class="m-0">Lorem elitr magna stet rebum dolores sed. Est stet labore est lorem lorem at
                                amet sea, eos tempor rebum, labore amet ipsum sea lorem, stet rebum eirmod amet. Kasd
                                clita kasd stet amet est dolor elitr.</p>
                        </div>
                    </div>
                    <div class="col-md-6 text-center text-md-left">
                        <img class="img-fluid ml-md-3" src="img/story-4.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Story End -->


    <!-- Gallery Start -->
    <div class="container-fluid bg-gallery" id="gallery" style="padding: 120px 0; margin: 90px 0;">
        <div class="section-title position-relative text-center" style="margin-bottom: 120px;">
            <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Gallery</h6>
            <h1 class="font-secondary display-4 text-white">Our Photo Gallery</h1>
            <i class="far fa-heart text-white"></i>
        </div>
        <div class="owl-carousel gallery-carousel">
            <div class="gallery-item">
                <img class="img-fluid w-100" src="img/gallery-1.png" alt="">
                <a href="img/gallery-1.jpg" data-lightbox="gallery">
                    <i class="fa fa-2x fa-plus text-white"></i>
                </a>
            </div>
            <div class="gallery-item">
                <img class="img-fluid w-100" src="img/gallery-2.jpg" alt="">
                <a href="img/gallery-2.jpg" data-lightbox="gallery">
                    <i class="fa fa-2x fa-plus text-white"></i>
                </a>
            </div>
            <div class="gallery-item">
                <img class="img-fluid w-100" src="img/gallery-3.jpg" alt="">
                <a href="img/gallery-3.jpg" data-lightbox="gallery">
                    <i class="fa fa-2x fa-plus text-white"></i>
                </a>
            </div>
            <div class="gallery-item">
                <img class="img-fluid w-100" src="img/gallery-4.jpg" alt="">
                <a href="img/gallery-4.jpg" data-lightbox="gallery">
                    <i class="fa fa-2x fa-plus text-white"></i>
                </a>
            </div>
            <div class="gallery-item">
                <img class="img-fluid w-100" src="img/gallery-5.jpg" alt="">
                <a href="img/gallery-5.jpg" data-lightbox="gallery">
                    <i class="fa fa-2x fa-plus text-white"></i>
                </a>
            </div>
            <div class="gallery-item">
                <img class="img-fluid w-100" src="img/gallery-6.jpg" alt="">
                <a href="img/gallery-6.jpg" data-lightbox="gallery">
                    <i class="fa fa-2x fa-plus text-white"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Gallery End -->


    <!-- Event Start -->
    <div class="container-fluid py-5" id="event">
        <div class="container py-5">
            <div class="section-title position-relative text-center">
                <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Event</h6>
                <h1 class="font-secondary display-4">Our Current Event</h1>
                <i class="far fa-heart text-dark"></i>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <h5 class="font-weight-normal text-muted mb-3 pb-3">We are currently organizing a wedding, focusing on creating a beautiful and memorable event for the couple and their guests. Our arrangements include selecting a charming venue, coordinating with a professional catering service for a delicious menu, and hiring skilled photographers to capture every special moment.
                    </h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 border-right border-primary">
                    <div class="text-center text-md-right mr-md-3 mb-4 mb-md-0">
                        <img class="img-fluid mb-4" src="img/event-1.png" alt="">
                        <h4 class="mb-3">The Reception</h4>
                        <p class="mb-2">Mirpur 12, Dhaka, Bangladesh</p>
                        <p class="mb-0">12:00AM - 01:00PM</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center text-md-left ml-md-3">
                        <img class="img-fluid mb-4" src="img/event-2.png" alt="">
                        <h4 class="mb-3">Wedding Party</h4>
                        <p class="mb-2">Mirpur 12, Dhaka, Bangladesh</p>
                        <p class="mb-0">12:00AM - 01:00PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Event End -->


    


    <!-- RSVP Start -->
    <div class="container-fluid py-5" id="rsvp">
        <div class="container py-5">
            <div class="section-title position-relative text-center">
                <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;">Book Event</h6>
                <h1 class="font-secondary display-4">Join Our Party</h1>
                <i class="far fa-heart text-dark"></i>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center">
                        <form method="POST">
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <input type="text" class="form-control bg-secondary border-0 py-4 px-3"
                                        placeholder="Your Name" name="name" />
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="email" class="form-control bg-secondary border-0 py-4 px-3"
                                        placeholder="Your Email" name="email" />
                                </div>
                            </div>
                            <div class="form-row">
                                <!-- <div class="form-group col-sm-6">
                                    <input type="Phone" class="form-control bg-secondary border-0 py-4 px-3"
                                        placeholder="Your Phone Number" />
                                </div> -->
                                <div class="form-group col-sm-6">
                                    <input type="password" class="form-control bg-secondary border-0 py-4 px-3"
                                        placeholder="Your password" name="password"/>
                                </div>
                                <div class="form-group col-sm-6">
                                    <select class="form-control bg-secondary border-0" style="height: 52px;" name="designation">
                                        <option value="nothing">Log in as</option>
                                        <option value="admin">Admin</option>
                                        <option value="user">User </option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <textarea class="form-control bg-secondary border-0 py-2 px-3" rows="5"
                                    placeholder="Message" required="required"></textarea>
                            </div> -->
                            <div>
                                <button class="btn btn-primary font-weight-bold py-3 px-5" name="login" type="submit" value="login">Login</button>
                                <button class="btn btn-primary font-weight-bold py-3 px-5 signUp" type="submit"><a href="signUp.php">SignUp...</a></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- RSVP End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white py-5" id="contact" style="margin-top: 90px;">
        <div class="container text-center py-5">
            <div class="section-title position-relative text-center">
                <h1 class="font-secondary display-3 text-white">Thank You</h1>
                <i class="far fa-heart text-white"></i>
            </div>
            <div class="d-flex justify-content-center mb-4">
                <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="https://www.facebook.com/profile.php?id=100009813286993"><i
                        class="fab fa-facebook-f"></i></a>
                <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i
                        class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-lg btn-outline-light btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
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


    <!-- Scroll to Bottom -->
    <i class="fa fa-2x fa-angle-down text-white scroll-to-bottom"></i>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-outline-primary btn-lg-square back-to-top"><i
            class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>





    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>



    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>

