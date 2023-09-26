<?php  
    include('../config/constants.php');

   echo $id = $_GET['id'];

    $sql = "DELETE FROM products WHERE `products`.`ID` = $id";

    $res = mysqli_query($conn, $sql);

    if ($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Deleted Successfully</div>";
        header("location:".SITEURL.'admin/manage-products.php');
    }
    else{
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Product</div>";
        header("location:".SITEURL.'admin/manage-products.php');
    }
        
?>