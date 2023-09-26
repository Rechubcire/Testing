<?php  
    include('partials/menu.php');

    $id = $_GET['prod_id'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $email = $_GET['email'];
    $address = $_GET['address1'] . " " . $_GET['address2'] . " " . $_GET['address3'] . " " . $_GET['address4'];
    $time = time();
    $id = $_GET['prod_id'];

    $sql = "SELECT * FROM products WHERE ID = $id";
    $res = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($res);
    if($row['sold']==0){

        $sql = "INSERT INTO `orders` (`order_id`, `prod_id`, `status`, `customer_address`, `customer_email`, `time`, `customer_first`, `customer_last`) VALUES (NULL, '$id', 'Pending', '$address', '$email',current_timestamp() , '$fname', '$lname')";
        $res = mysqli_query($conn, $sql); //insert new order

        $sql = "SELECT * FROM orders WHERE prod_id = $id"; //get order id
        $res = mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($res);
        $orderId = $row['order_id'];

        if($res==true)
        {
            //mail(Client_Email,"Order Placed","Product Number $id was ordered by $fname $lname ($email). Their shipping address is $address");
            //send to client

            //mail($email,"Order Receipt","Thank you for your order! \n \n Your order ID is $orderId. If you have any questions, please contact us at " .Client_Email);
            //send to customer

            $sql = "UPDATE products SET sold = '1' WHERE ID = $id";
            $res = mysqli_query($conn, $sql);
            header("location:".SITEURL.'php/thanks.php');
        }
        else{
            echo '<p style="padding-top:200px; text-align:center;">Error sending order, please contact us if you have any questions<br></p>';
            echo '<p class="center" style="padding-top:200px; padding-bottom:30vh;"><a href="products.php" class="btn-secondary">back to shop page</a></p>';
        }
    }
    else{
        echo '<p style="padding-top:200px; text-align:center;">Error: product marked as sold, please contact us if you have any questions<br></p>';
        echo '<p class="center" style="padding-top:200px; padding-bottom:30vh;"><a href="products.php" class="btn-secondary">back to shop page</a></p>';
    }
    include('partials/footer.php');
?>