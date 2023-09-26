<?php
    include('../config/constants.php');
    if(isset($_SESSION['orderSearch'])){
        unset($_SESSION['orderSearch']);
    }else{
        $_SESSION['orderSearch'] = true;
    }
    header("location:" . SITEURL . 'admin/manage-orders.php'); 
?>