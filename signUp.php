<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Home</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="signUp.css" />
  </head>
  <body>
    <div class="container">
      <div class="center">
          <h1>Register</h1>
          <form method="POST" action=""  enctype="multipart/form-data">
              <div class="txt_field">
                  <input type="text" name="username" required>
                  <span></span>
                  <label>Name</label>
              </div>
              <div class="txt_field">
                  <input type="email" name="email" required>
                  <span></span>
                  <label>Email</label>
              </div>
              <div class="txt_field">
                  <input type="Phone" name="phone" required>
                  <span></span>
                  <label>Phone number</label>
              </div>
              <div class="txt_field">
                  <input type="password" name="password" required>
                  <span></span>
                  <label>Password</label>
              </div>
              <div class="" style="padding-bottom: 15px; margin-top: -15px;">
                  <span></span>
                  <label style="color: #f8905c; margin-bottom: 5px;">Profile Image</label><br>
                  <input type="file" name="profile_image" required>
              </div>
              <input name="submit" type="Submit" value="Sign Up">
              <div class="signup_link">
                  Have an Account ? <a href="index.php">Login Here</a>
              </div>
          </form>
      </div>
  </div>
  </body>
</html>

<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
include("function.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $profile_image = $_FILES['profile_image'];


    
    $conn = new mysqli($servername, $db_username, $db_password);// this variable is in db.php

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $result = $conn->query("SHOW DATABASES LIKE 'eventmanage'");
    if ($result->num_rows == 0) {
        // Database does not exist, create it
        $sql = "CREATE DATABASE eventmanage";
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $conn->error;
        }
    } else {
        // echo "Database 'eventmanage' already exists";
    }

    

    $query = "Use eventmanage";

    if ($conn -> query($query) === true)
    {
    // echo "Success";
    }
    else
    {
        die("Error");
    }

    $result = $conn->query("SHOW TABLES LIKE 'users'");

    if ($result->num_rows == 0) {
        // Table does not exist, create it
        $sql = "CREATE TABLE users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            u_name VARCHAR(30) NOT NULL,
            email VARCHAR(50) NOT NULL,
            u_password VARCHAR(30) NOT NULL,
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            profile_image VARCHAR(255) NOT NULL
        )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
        
        if ($conn->query($sql) === TRUE) {
            echo "Table Users created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    } else {
        // echo "Table Users already exists";
    }



    if (!empty($username) && !empty($password) && !empty($email)) {
        // Check if username or email already exists
        $query = "SELECT * FROM users WHERE u_name='$username' OR email='$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username or email already exists! Please choose another');</script>";
        } else {
            // Handle image upload
            $target_dir = "uploads/";
            // Check if the directory exists, if not, create it
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $target_file = $target_dir . basename($profile_image["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($profile_image["tmp_name"]);
            if ($check === false) {
                die("File is not an image.");
            }

            // Check file size (limit to 500KB)
            if ($profile_image["size"] > 500000) {
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
            if (!move_uploaded_file($profile_image["tmp_name"], $target_file)) {
                die("Sorry, there was an error uploading your file.");
            }

            // Save to database
            $query = "INSERT INTO users (u_name,email, u_password, profile_image, phone) VALUES ('$username','$email', '$password','$target_file', '$phone')";
            mysqli_query($conn, $query);
            header("Location: index.php");
            die;
        }
    } else {
        echo "Please enter some valid information!";
    }
}
?>