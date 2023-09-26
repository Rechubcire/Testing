<?php  
    include('../config/constants.php');

    echo $id = $_GET['id'];
    echo $featured = $_GET['feat'];
    if ($featured == 0) {
        $featured = 1;
    } else {
        $featured = 0;
    }

    $sql = "UPDATE products SET featured = '$featured' WHERE ID = $id;";

    $res = mysqli_query($conn, $sql);
    header("location:".SITEURL.'admin/manage-products.php');     
?>