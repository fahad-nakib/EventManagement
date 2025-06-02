<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navbar.css">
    <title>Responsive Navbar</title>
</head>
<body>

<nav class="navbar">
    <div class="brand-title">CelebrationStation</div>
    <a href="javascript:void(0);" class="toggle-button" onclick="toggleMenu()">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </a>
    <div class="navbar-links" id="navbar-links">
        <ul>
            <li><a href="#">WEADDING</a></li>
            <li><a href="#">ENGAGEMENT</a></li>
            <li><a href="#">BIRTHDAY</a></li>
            <li><a href="#">FIRSTMEET</a></li>
            <li><a href="#">OTHERS</a></li>
            <li><a href="#">EVENTBOOKING</a></li>
            <li><a href="#">CONTACT</a></li>
        </ul>
    </div>
</nav>

<script>
function toggleMenu() {
    var navbarLinks = document.getElementById("navbar-links");
    navbarLinks.classList.toggle("active");
}
</script>

</body>
</html>
