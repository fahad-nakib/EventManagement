<?php
session_start();
require_once('db.php');
include("function.php");

// $sql = "SELECT* FROM eventlist";
// $result = mysqli_query($conn, $sql);
$user_id;
if(isset($_SESSION['id']))
{
	$user_id = $_SESSION['id'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected date and time from the form
    $selected_date = $_POST['date'];
    $selected_time = $_POST['time'];
    $selected_event = $_POST['evn_id'];

    // Display the selected date and time
    echo "You have selected: <br>";
    echo "Date: " . htmlspecialchars($selected_date) . "<br>";
    echo "Time: " . htmlspecialchars($selected_time) . "<br>";
    echo "evn_id: " . htmlspecialchars($selected_event);

    $evn_type = "";
    $evn_desc = "";
    $evn_price ="";
    $evn_name = "";
    $evn_img ="";

    $query = "select * from eventlist where evn_id = '$selected_event'";
	$result = mysqli_query($conn, $query);
			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);
                    $evn_type = $user_data['evn_type'];
                    $evn_desc = $user_data['evn_desc'];
                    $evn_price = $user_data['evn_price'];
                    $evn_name = $user_data['evn_name'];
                    $evn_img = $user_data['evn_img'];
                }
            }
    $query = "INSERT INTO `occation`(`selected_event`, `user_id`, `evn_type`, `evn_name`, `evn_desc`, `evn_price`, `evn_date`, `evn_time`, `evn_img`) VALUES ('$selected_event','$user_id','$evn_type','$evn_name','$evn_desc','$evn_price','$selected_date','$selected_time','$evn_img')";
    mysqli_query($conn, $query);
    header("Location: evn_book.php");
    die;    
}

$weadding_count = 0;
$engagement_count =0;
$birthday_count = 0;

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
                <li><a href="#weadding" class="nav-item nav-link active">WEADDING</a></li>
                <li><a href="#engagement" class="nav-item nav-link active">ENGAGEMENT</a></li>
                <li><a href="#birthday" class="nav-item nav-link active">BIRTHDAY</a></li>
                <li><a href="#firstmeet" class="nav-item nav-link active">FIRSTMEET</a></li>
                <li><a href="#others" class="nav-item nav-link active">OTHERS</a></li>
                <li><a href="profile.php" class="nav-item nav-link active">PROFILE</a></li>
                <li><a href="logout.php" class="nav-item nav-link active">LOGOUT</a></li>

            </ul>
        </div>
    </nav>

    <section>
        <div class="container-fluid py-0" id="weadding">
            <div class="container py-5">
                <div class="section-title position-relative text-center">
                    <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;"></h6>
                    <h1 class="font-secondary display-4 ">Weadding Event</h1>
                    <i class="far fa-heart text-dark"></i>
                </div>
                <div class="m-0 mb-4 mb-md-0 pb-2 pb-md-0 ">
                    <?php
                    $sql = "SELECT* FROM eventlist";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        if ($row['evn_type'] == "weadding") 
                        {
                        ?>
                            <?php if ($weadding_count % 2 !== 0) : $weadding_count++; ?>
                            <div class="row m-0 mb-4 mb-md-0 pb-2 pb-md-0 ">
                                <div class=" col-md-6 p-0 text-center text-md-right">
                                    <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                                        <h3 class="mb-3"><?php echo $row['evn_name'] ?></h3>
                                        <p><b>Cost : BDT <?php echo $row['evn_price'] ?></b><br>
                                            <?php echo $row['evn_desc'] ?></p>
                                        <div class="position-relative">
                                            <!-- yuyiuyi         -->
                                            <div class="container">
                                                <form action="" method="post">
                                                    <div class="form-group">
                                                        <label for="date">Select Date:</label>
                                                        <input type="date" id="date" name="date" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="time">Select Time:</label>
                                                        <input type="time" id="time" name="time" required>
                                                        <input type="hidden" name="evn_id" value="<?php echo $row['evn_id'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                        <input class="btn btn-outline-primary btn-square mr-1" type="submit" value="SUBMIT">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-6 p-0" style="min-height: 400px;">
                                    <img class="position-absolute w-100 h-100" src="<?php echo $row['evn_img'] ?>" style="object-fit: cover;">
                                </div>
                            </div>
                                

                            <?php else : $weadding_count++; ?>
                                <div class="row m-0">
                                    <div class="col-md-6 p-0" style="min-height: 400px;">
                                        <img class="position-absolute w-100 h-100 " src="<?php echo $row['evn_img'] ?>" style="object-fit: cover;">
                                    </div>
                                    <div class="col-md-6 p-0 text-center text-md-left">
                                        <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                                            <h3 class="mb-3"><?php echo $row['evn_name'] ?></h3>
                                            <p><b>Cost :<?php echo $row['evn_price'] ?></b><br>
                                                <?php echo $row['evn_desc'] ?>
                                            </p>
                                            <div class="position-relative">
                                                <div class="container">
                                                    <form action="" method="post">
                                                        <div class="form-group">
                                                            <label for="date">Select Date:</label>
                                                            <input type="date" id="date" name="date" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="time">Select Time:</label>
                                                            <input type="time" id="time" name="time" required>
                                                            <input type="hidden" name="evn_id" value="<?php echo $row['evn_id'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="btn btn-outline-primary btn-square mr-1" type="submit" value="SUBMIT">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                    <?php
                        }
                    }

                    ?>
                </div>
            </div>

        </div>
        <!-- Event End -->
        <div class="container-fluid py-0" id="engagement">
            <div class="container py-5">
                <div class="section-title position-relative text-center">
                    <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;"></h6>
                    <h1 class="font-secondary display-4">Engagement Event</h1>
                    <i class="far fa-heart text-dark"></i>
                </div>
                <div class="m-0 mb-4 mb-md-0 pb-2 pb-md-0 ">
                    <?php
                    $sql = "SELECT* FROM eventlist";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        if ($row['evn_type'] == "engagement") 
                        {
                        ?>
                            <?php if ($weadding_count % 2 !== 0) : $weadding_count++; ?>
                            <div class="row m-0 mb-4 mb-md-0 pb-2 pb-md-0 ">
                                <div class=" col-md-6 p-0 text-center text-md-right">
                                    <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                                        <h3 class="mb-3"><?php echo $row['evn_name'] ?></h3>
                                        <p><b>Cost : BDT <?php echo $row['evn_price'] ?></b><br>
                                            <?php echo $row['evn_desc'] ?></p>
                                        <div class="position-relative">
                                            <!-- yuyiuyi         -->
                                            <div class="container">
                                                <form action="" method="post">
                                                    <div class="form-group">
                                                        <label for="date">Select Date:</label>
                                                        <input type="date" id="date" name="date" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="time">Select Time:</label>
                                                        <input type="time" id="time" name="time" required>
                                                        <input type="hidden" name="evn_id" value="<?php echo $row['evn_id'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="btn btn-outline-primary btn-square mr-1" type="submit" value="Submit">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-6 p-0" style="min-height: 400px;">
                                    <img class="position-absolute w-100 h-100" src="<?php echo $row['evn_img'] ?>" style="object-fit: cover;">
                                </div>
                            </div>
                                

                            <?php else : $weadding_count++; ?>
                                <div class="row m-0">
                                    <div class="col-md-6 p-0" style="min-height: 400px;">
                                        <img class="position-absolute w-100 h-100 " src="<?php echo $row['evn_img'] ?>" style="object-fit: cover;">
                                    </div>
                                    <div class="col-md-6 p-0 text-center text-md-left">
                                        <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                                            <h3 class="mb-3"><?php echo $row['evn_name'] ?></h3>
                                            <p><b>Cost :<?php echo $row['evn_price'] ?></b><br>
                                                <?php echo $row['evn_desc'] ?>
                                            </p>
                                            <div class="position-relative">
                                                <div class="container">
                                                    <form action="" method="post">
                                                        <div class="form-group">
                                                            <label for="date">Select Date:</label>
                                                            <input type="date" id="date" name="date" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="time">Select Time:</label>
                                                            <input type="time" id="time" name="time" required>
                                                            <input type="hidden" name="evn_id" value="<?php echo $row['evn_id'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="btn btn-outline-primary btn-square mr-1" type="submit" value="Purse">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                    <?php
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
        <div class="container-fluid py-0" id="birthday">
            <div class="container py-5">
                <div class="section-title position-relative text-center">
                    <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;"></h6>
                    <h1 class="font-secondary display-4">Birth Day Event</h1>
                    <i class="far fa-heart text-dark"></i>
                </div>
                <div class="m-0 mb-4 mb-md-0 pb-2 pb-md-0 ">
                    <?php
                    $sql = "SELECT* FROM eventlist";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        if ($row['evn_type'] == "birthday") 
                        {
                        ?>
                            <?php if ($weadding_count % 2 !== 0) : $weadding_count++; ?>
                            <div class="row m-0 mb-4 mb-md-0 pb-2 pb-md-0 ">
                                <div class=" col-md-6 p-0 text-center text-md-right">
                                    <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                                        <h3 class="mb-3"><?php echo $row['evn_name'] ?></h3>
                                        <p><b>Cost : BDT <?php echo $row['evn_price'] ?></b><br>
                                            <?php echo $row['evn_desc'] ?></p>
                                        <div class="position-relative">
                                            <!-- yuyiuyi         -->
                                            <div class="container">
                                                <form action="" method="post">
                                                    <div class="form-group">
                                                        <label for="date">Select Date:</label>
                                                        <input type="date" id="date" name="date" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="time">Select Time:</label>
                                                        <input type="time" id="time" name="time" required>
                                                        <input type="hidden" name="evn_id" value="<?php echo $row['evn_id'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="btn btn-outline-primary btn-square mr-1" type="submit" value="Submit">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-6 p-0" style="min-height: 400px;">
                                    <img class="position-absolute w-100 h-100" src="<?php echo $row['evn_img'] ?>" style="object-fit: cover;">
                                </div>
                            </div>
                                

                            <?php else : $weadding_count++; ?>
                                <div class="row m-0">
                                    <div class="col-md-6 p-0" style="min-height: 400px;">
                                        <img class="position-absolute w-100 h-100 " src="<?php echo $row['evn_img'] ?>" style="object-fit: cover;">
                                    </div>
                                    <div class="col-md-6 p-0 text-center text-md-left">
                                        <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                                            <h3 class="mb-3"><?php echo $row['evn_name'] ?></h3>
                                            <p><b>Cost :<?php echo $row['evn_price'] ?></b><br>
                                                <?php echo $row['evn_desc'] ?>
                                            </p>
                                            <div class="position-relative">
                                                <div class="container">
                                                    <form action="" method="post">
                                                        <div class="form-group">
                                                            <label for="date">Select Date:</label>
                                                            <input type="date" id="date" name="date" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="time">Select Time:</label>
                                                            <input type="time" id="time" name="time" required>
                                                            <input type="hidden" name="evn_id" value="<?php echo $row['evn_id'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="btn btn-outline-primary btn-square mr-1" type="submit" value="Purse">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                    <?php
                        }
                    }

                    ?>
                </div>
            </div>
        </div>

        <div class="container-fluid py-0" id="firstmeet">
            <div class="container py-5">
                <div class="section-title position-relative text-center">
                    <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;"></h6>
                    <h1 class="font-secondary display-4">Firstmeet Event</h1>
                    <i class="far fa-heart text-dark"></i>
                </div>
                <div class="m-0 mb-4 mb-md-0 pb-2 pb-md-0 ">
                    <?php
                    $sql = "SELECT* FROM eventlist";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        if ($row['evn_type'] == "firstmeet") 
                        {
                        ?>
                            <?php if ($weadding_count % 2 !== 0) : $weadding_count++; ?>
                            <div class="row m-0 mb-4 mb-md-0 pb-2 pb-md-0 ">
                                <div class=" col-md-6 p-0 text-center text-md-right">
                                    <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                                        <h3 class="mb-3"><?php echo $row['evn_name'] ?></h3>
                                        <p><b>Cost : BDT <?php echo $row['evn_price'] ?></b><br>
                                            <?php echo $row['evn_desc'] ?></p>
                                        <div class="position-relative">
                                            <!-- yuyiuyi         -->
                                            <div class="container">
                                                <form action="" method="post">
                                                    <div class="form-group">
                                                        <label for="date">Select Date:</label>
                                                        <input type="date" id="date" name="date" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="time">Select Time:</label>
                                                        <input type="time" id="time" name="time" required>
                                                        <input type="hidden" name="evn_id" value="<?php echo $row['evn_id'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="btn btn-outline-primary btn-square mr-1" type="submit" value="Submit">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-6 p-0" style="min-height: 400px;">
                                    <img class="position-absolute w-100 h-100" src="<?php echo $row['evn_img'] ?>" style="object-fit: cover;">
                                </div>
                            </div>
                                

                            <?php else : $weadding_count++; ?>
                                <div class="row m-0">
                                    <div class="col-md-6 p-0" style="min-height: 400px;">
                                        <img class="position-absolute w-100 h-100 " src="<?php echo $row['evn_img'] ?>" style="object-fit: cover;">
                                    </div>
                                    <div class="col-md-6 p-0 text-center text-md-left">
                                        <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                                            <h3 class="mb-3"><?php echo $row['evn_name'] ?></h3>
                                            <p><b>Cost :<?php echo $row['evn_price'] ?></b><br>
                                                <?php echo $row['evn_desc'] ?>
                                            </p>
                                            <div class="position-relative">
                                                <div class="container">
                                                    <form action="" method="post">
                                                        <div class="form-group">
                                                            <label for="date">Select Date:</label>
                                                            <input type="date" id="date" name="date" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="time">Select Time:</label>
                                                            <input type="time" id="time" name="time" required>
                                                            <input type="hidden" name="evn_id" value="<?php echo $row['evn_id'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="btn btn-outline-primary btn-square mr-1" type="submit" value="Purse">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                    <?php
                        }
                    }

                    ?>
                </div>
            </div>
        </div>



        <div class="container-fluid py-0" id="others">
            <div class="container py-5">
                <div class="section-title position-relative text-center">
                    <h6 class="text-uppercase text-primary mb-3" style="letter-spacing: 3px;"></h6>
                    <h1 class="font-secondary display-4">Other Events</h1>
                    <i class="far fa-heart text-dark"></i>
                </div>
                <div class="m-0 mb-4 mb-md-0 pb-2 pb-md-0 ">
                    <?php
                    $sql = "SELECT* FROM eventlist";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        if ($row['evn_type'] == "others") 
                        {
                        ?>
                            <?php if ($weadding_count % 2 !== 0) : $weadding_count++; ?>
                            <div class="row m-0 mb-4 mb-md-0 pb-2 pb-md-0 ">
                                <div class=" col-md-6 p-0 text-center text-md-right">
                                    <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                                        <h3 class="mb-3"><?php echo $row['evn_name'] ?></h3>
                                        <p><b>Cost : BDT <?php echo $row['evn_price'] ?></b><br>
                                            <?php echo $row['evn_desc'] ?></p>
                                        <div class="position-relative">
                                            <!-- yuyiuyi         -->
                                            <div class="container">
                                                <form action="" method="post">
                                                    <div class="form-group">
                                                        <label for="date">Select Date:</label>
                                                        <input type="date" id="date" name="date" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="time">Select Time:</label>
                                                        <input type="time" id="time" name="time" required>
                                                        <input type="hidden" name="evn_id" value="<?php echo $row['evn_id'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="btn btn-outline-primary btn-square mr-1" type="submit" value="Submit">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-6 p-0" style="min-height: 400px;">
                                    <img class="position-absolute w-100 h-100" src="<?php echo $row['evn_img'] ?>" style="object-fit: cover;">
                                </div>
                            </div>
                                

                            <?php else : $weadding_count++; ?>
                                <div class="row m-0">
                                    <div class="col-md-6 p-0" style="min-height: 400px;">
                                        <img class="position-absolute w-100 h-100 " src="<?php echo $row['evn_img'] ?>" style="object-fit: cover;">
                                    </div>
                                    <div class="col-md-6 p-0 text-center text-md-left">
                                        <div class="h-100 d-flex flex-column justify-content-center bg-secondary p-5">
                                            <h3 class="mb-3"><?php echo $row['evn_name'] ?></h3>
                                            <p><b>Cost :<?php echo $row['evn_price'] ?></b><br>
                                                <?php echo $row['evn_desc'] ?>
                                            </p>
                                            <div class="position-relative">
                                                <div class="container">
                                                    <form action="" method="post">
                                                        <div class="form-group">
                                                            <label for="date">Select Date:</label>
                                                            <input type="date" id="date" name="date" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="time">Select Time:</label>
                                                            <input type="time" id="time" name="time" required>
                                                            <input type="hidden" name="evn_id" value="<?php echo $row['evn_id'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="btn btn-outline-primary btn-square mr-1" type="submit" value="Purse">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                    <?php
                        }
                    }

                    ?>
                </div>
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