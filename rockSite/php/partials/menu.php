<?php include('../config/constants.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Peace, Love, and Dots site page showcasing magnificent painted rocks">
    <meta name="viewport" content="width=device-width", initial-scale="1.0">
    <link rel="stylesheet" href="../css/stylesheet.css">
    <script src="../scripts/menuClick.js"></script>
    <title>Peace, Love, & Dots</title>
</head> 
<body class="background">  <!-- Background color-->

<?php include('promotion.php')?>

<div class="navbar">
    
    <a href="home.php"><img src="../images/navbar_logo.webp" alt="Heart Rock in cornner with company motto 'peace love and dots' next to it" class="banner"></a>
    <div class="navlinks">
        <a href="products.php">Shop</a>
        <a href="about.php">About</a>
    </div>

    <div class="menu">
        <div class="menu-lines">
            <div class="hamburger" onclick="menuClick()">
                <div class="ham-line hl1"></div>
                <div class="ham-line hl2"></div>
                <div class="ham-line hl3"></div>
            </div>
            <div id="dropdown" class="dropdown-content">
                <img src="../images/icons/homeicon.png" class="dropdown-img">
                <a href="home.php">Home</a>
                <img src="../images/icons/shopicon.png" class="dropdown-img">
                <a href="products.php">Shop</a>
                <img src="../images/icons/abouticon.png" class="dropdown-img">
                <a href="about.php">About</a>
            </div>
        </div>
    </div>
</div>


</body>
</html>
