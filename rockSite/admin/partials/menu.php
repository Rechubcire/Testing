<?php include('../config/constants.php') ?>
<html>
    <head>
        <title>Rock Website - Home Page </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
<body>
    <!-- Sidebar -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                
                <li><a href="index.php"><img src="<?php echo SITEURL;?>/images/icons/home.webp" alt="Home Icon" width = "50%">
                <br>Home</a></li>
                <br><br><br>

                <li><a href="manage-products.php"><img src="<?php echo SITEURL;?>/images/icons/art-studies.webp" alt="Product Icon" width = "50%">
                <br>Products</a></li>
                <br><br><br>
                
                <li><a href="manage-promos.php"><img src="<?php echo SITEURL;?>/images/icons/megaphone.webp" alt="User Icon" width = "50%">
                <br>Promotions</a></li>
                <br><br><br>

                <li><a href="manage-types.php"><img src="<?php echo SITEURL;?>/images/icons/menu.webp" alt="Types Icon" width = "50%">
                <br>Categories</a></li>
                <br><br><br>

                <li><a href="manage-orders.php"><img src="<?php echo SITEURL;?>/images/icons/box.webp" alt="Order Icon" width = "50%">
                <br>Orders</a></li>
                <br><br><br>

                <li><a href="manage-account.php"><img src="<?php echo SITEURL;?>/images/icons/user.webp" alt="User Icon" width = "50%">
                <br>Account</a></li>
            </ul>
        </div>
    </div>
<!--End Sidebar -->

</body>
    <?php //Session Timeout Code
        if ($_SESSION["loggedIn"] == null) {
            header("location:".SITEURL.'admin/login.php');
            $_SESSION["loggedIn"] = false;
            $_SESSION['timestamp'] = time();
        }
        else if((time() - $_SESSION['timestamp'])> 900) { /* If no activity for 15 min, timeout */
            $_SESSION["loggedIn"] = "sorry";
            header("location:".SITEURL.'admin/login.php');
        }
        if ($_SESSION["loggedIn"] == false) {
            header("location:".SITEURL.'admin/login.php');
        }
        else {
            $_SESSION['timestamp'] = time();
        } 
    ?>
</html>