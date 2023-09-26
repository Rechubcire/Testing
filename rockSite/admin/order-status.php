<?php  
    include('../config/constants.php');

    echo $id = $_GET['id'];
    echo $status = $_GET['status'];
    if ($status == "Pending") {
        $status = "Complete";
    } else {
        $status = "Pending";
    }

    $sql = "UPDATE orders SET status = '$status' WHERE order_id = '$id';";

    $res = mysqli_query($conn, $sql);
    header("location:".SITEURL.'admin/manage-orders.php');     
?>