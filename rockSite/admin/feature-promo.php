<?php  
    include('../config/constants.php');

    $sql = "UPDATE promotions SET featured = '0' WHERE id > 0;"; //unset
    $res = mysqli_query($conn, $sql);

    $id = $_GET['id'];
    $flip = $_GET['flipped'];

    $sql = "UPDATE promotions SET featured = '$flip' WHERE id = $id;";
    $res = mysqli_query($conn, $sql);

    header("location:".SITEURL.'admin/manage-promos.php');     
?>